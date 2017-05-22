package main

import (
	log "github.com/Sirupsen/logrus"

	acceptor_client "github.com/linkit360/go-acceptor-client"
)

func main() {
	cfg := acceptor_client.ClientConfig{
		Enabled: true,
		DSN:     ":50318",
		Timeout: 10,
	}

	//log.Printf("%+v\n", cfg)

	if err := acceptor_client.Init(cfg); err != nil {
		log.Panicln("Cannot init acceptor client")
	}
	log.Infoln("Connected")

	//resp, err := acceptor_client.SendAggregatedData(data2)
	//if err != nil {
	//	log.Errorln(err.Error())
	//}

	//log.Println(resp)

	/*
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
		resp, err := acceptor_client.SendAggregatedData(data2)
		if err != nil {
		log.Println("Error")
		log.Println(err.Error())
		}

		log.Println(resp)



		data, err := acceptor_client.CampaignsGet("cheese")
		if err != nil {
		log.Println("Error")
		log.Fatalln(err.Error())
		}

		log.Println("DATA")
		log.Printf("%+v\n", data)
	*/
}
