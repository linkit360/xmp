package websocket

import (
	"fmt"
	"log"
	"net/http"
	"time"

	"acceptor/src/base"
	"github.com/gorilla/websocket"
)

//var counter uint = 0
//var clients map[uint]string
var upgrader = websocket.Upgrader{
	CheckOrigin: func(r *http.Request) bool {
		return true
	},
}

func Init() {
	http.HandleFunc("/echo", echo)
	log.Println("WS: Init Done")
	log.Fatal(http.ListenAndServe(":3000", nil))
}

func echo(w http.ResponseWriter, r *http.Request) {
	log.Println("WS: echo")

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
			err := c.WriteMessage(websocket.TextMessage, []byte(sendTotal()))
			if err != nil {
				log.Println("write: ", err)
				return
			}
		}
	}
}

func sendTotal() string {
	return fmt.Sprint(base.GetLpHits())
}
