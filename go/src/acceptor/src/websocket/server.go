package websocket

import (
	"fmt"
	"log"
	"net/http"
	"time"

	"acceptor/src/base"
	"github.com/gorilla/websocket"
)

var lpHits uint64 = 0

var upgrader = websocket.Upgrader{
	CheckOrigin: func(r *http.Request) bool {
		return true
	},
}

func Init() {
	// init starting value
	lpHits = base.GetLpHits()

	http.HandleFunc("/echo", echo)
	log.Println("WS:", "Init Done")
	log.Fatal(http.ListenAndServe(":3000", nil))
}

func echo(w http.ResponseWriter, r *http.Request) {
	log.Println("WS:", "Echo")

	c, err := upgrader.Upgrade(w, r, nil)
	if err != nil {
		log.Print("upgrade:", err)
		return
	}
	defer c.Close()

	ticker := time.NewTicker(time.Second)
	defer ticker.Stop()

	for {
		select {
		case <-ticker.C:
			err := c.WriteMessage(websocket.TextMessage, []byte(fmt.Sprint(lpHits)))
			if err != nil {
				//log.Println("WS:","write: ", err)
				c.Close()
				return
			}
		}
	}
}

func LpHitsToday(rows []base.Aggregate) {
	hitsOld := lpHits
	for _, row := range rows {
		lpHits = lpHits + uint64(row.LpHits)
	}
	log.Println(
		"WS:",
		"LpHitsToday", lpHits,
		"( +", lpHits - hitsOld, ")",
	)
}
