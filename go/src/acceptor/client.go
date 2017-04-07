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
	//log.Printf("%+v\n", cfg)

	if err := acceptor_client.Init(cfg); err != nil {
		log.Println("cannot init acceptor client")
	}

	// Get BL All
	data, err := acceptor_client.BlackListGet("cheese")
	if err != nil {
		log.Println("Error")
		log.Fatalln(err.Error())
	}

	log.Println("DATA")
	log.Printf("%+v\n", data)

	// Get BL Time
	data, err = acceptor_client.BlackListGetNew("cheese", "2000-01-01")
	if err != nil {
		log.Println("Error")
		log.Fatalln(err.Error())
	}

	log.Println("DATA")
	log.Printf("%+v\n", data)

	// Send Aggregate
	data2 := []acceptor.Aggregate{
		acceptor_client.GetRandomAggregate(),
	}

	//log.Println(data)
	err = acceptor_client.SendAggregatedData(data2)
	if err != nil {
		log.Println("Error")
		log.Println(err.Error())
	}

}
