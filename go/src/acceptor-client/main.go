package main

import (
	"log"

	acceptor_client "github.com/linkit360/go-acceptor-client"
	acceptor "github.com/linkit360/go-acceptor-structs"
)

func main() {
	cfg := acceptor_client.ClientConfig{
		Enabled: true,
		DSN:     ":50318",
		Timeout: 10,
	}
	log.Printf("%+v\n", cfg)

	if err := acceptor_client.Init(cfg); err != nil {
		log.Println("cannot init acceptor client")
	}

	data := []acceptor.Aggregate{
		acceptor_client.GetRandomAggregate(),
	}

	log.Println(data)
	err := acceptor_client.SendAggregatedData(data)
	if err != nil {
		log.Println("Error")
		log.Println(err.Error())
	}
}
