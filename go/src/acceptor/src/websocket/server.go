package websocket

import (
	"encoding/json"
	"net/http"
	"time"

	"acceptor/src/base"
	log "github.com/Sirupsen/logrus"
	"github.com/gorilla/websocket"
)

var lastResetTime int = 0
var upgrader = websocket.Upgrader{
	CheckOrigin: func(r *http.Request) bool {
		return true
	},
}

type Data struct {
	LpHits     uint64            `json:"lp"`
	Mo         uint64            `json:"mo"`
	MoSuccess  uint64            `json:"mos"`
	Countries  map[string]uint64 `json:"countries"`
	Logs       []string          `json:"logs"`
	ClientsCnt uint              `json:"clientsCnt"`
}

var data = Data{}
var provs = map[string]string{}

func Init() {
	reset()
	go resetDay()

	http.HandleFunc("/echo", echo)
	log.WithFields(log.Fields{
		"prefix": "WS",
	}).Info("Init Done")

	//env := config.EnvString("PROJECT_ENV", "dev")
	//if env == "dev" {
	log.Fatal(http.ListenAndServe(":3000", nil))
	//} else {
	//	log.Fatal(http.ListenAndServeTLS(":3000", "/config/ssl/crt.crt", "/config/ssl/priv.key", nil))
	//}
}

func echo(w http.ResponseWriter, r *http.Request) {
	log.WithFields(log.Fields{
		"prefix": "WS",
	}).Info("Connect")

	c, err := upgrader.Upgrade(w, r, nil)
	if err != nil {
		log.WithFields(log.Fields{
			"prefix": "WS",
			"error":  err,
		}).Error("Upgrade")
		return
	}
	defer c.Close()

	data.ClientsCnt = data.ClientsCnt + 1

	ticker := time.NewTicker(time.Second)
	defer ticker.Stop()

	for {
		select {
		case <-ticker.C:
			err := c.WriteMessage(websocket.TextMessage, []byte(prepData()))
			if err != nil {
				//log.Println("WS:","write: ", err)
				c.Close()
				data.ClientsCnt = data.ClientsCnt - 1
				return
			}
		}
	}
}

func NewReports(rows []base.Aggregate) {
	//hitsOld := dataLp
	for _, row := range rows {
		data.LpHits = data.LpHits + uint64(row.LpHits)
		data.Mo = data.Mo + uint64(row.Mo)
		data.MoSuccess = data.MoSuccess + uint64(row.MoSuccess)
		data.Countries[provs[row.ProviderName]] = data.Countries[provs[row.ProviderName]] + uint64(row.LpHits)

		log.WithFields(log.Fields{
			"prefix": "WS",
		}).Infof("New Report: %+v", row)

		//if len(data.Logs) > 10 {
		//	data.Logs = data.Logs[:len(data.Logs)-1]
		//}
		//data.Logs = append(data.Logs, fmt.Sprintf("New Report: %+v", row))
	}
}

func resetDay() {
	ticker := time.NewTicker(time.Minute)
	go func() {
		for t := range ticker.C {
			if lastResetTime != t.Day() {
				reset()
				log.WithFields(log.Fields{
					"prefix": "WS",
				}).Info("Reset Day")
			}
		}
	}()
}

func reset() {
	data.Countries, provs, data.LpHits, data.Mo, data.MoSuccess = base.GetWsData()
	lastResetTime = time.Now().Day()
	//fmt.Printf("%+v", provs)
}

func prepData() string {
	mapB, _ := json.Marshal(data)
	return string(mapB)
}
