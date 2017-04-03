package main

import (
	"log"

	acceptor_client "github.com/linkit360/go-acceptor-client"
	acceptor "github.com/linkit360/go-acceptor-structs"
)

func main() {
	cfg := acceptor_client.ClientConfig{DSN: ":50318", Timeout: 10}
	if err := acceptor_client.Init(cfg); err != nil {
		log.Println("cannot init acceptor client")
	}

	data := []acceptor.Aggregate{
		acceptor_client.GetRandomAggregate(),
	}

	acceptor_client.SendAggregatedData(data)
}
