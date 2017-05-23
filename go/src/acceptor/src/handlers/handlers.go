package handlers

import (
	"acceptor/src/base"
	"acceptor/src/websocket"

	log "github.com/Sirupsen/logrus"
	acceptorStructs "github.com/linkit360/go-acceptor-structs"
	"gopkg.in/gin-gonic/gin.v1"
)

func Initialization(c *gin.Context) {
	log.Info("")
	log.Info("Call Initialization")
	var instance_id string = c.Query("instance_id")
	log.Info(instance_id)

	status, id_operator := base.GetOptions(instance_id)
	out := gin.H{
		"ok":     false,
		"status": status,
	}

	if status == 1 {
		out["ok"] = true
		out["id_operator"] = id_operator
	}

	c.JSON(
		200,
		out,
	)
}

func Aggregate(c *gin.Context) {
	log.Info("")
	log.Info("Call Aggregate")
	var instance_id string = c.Query("instance_id")
	log.Info(instance_id)

	items := []acceptorStructs.Aggregate{}

	out := gin.H{
		"ok": true,
	}

	if c.BindJSON(&items) == nil {
		log.Info(items)

		websocket.NewReports(items)
		err := base.SaveRows(items)
		if err != nil {
			out["ok"] = false
			log.Error("Aggregate Save:", err)
		}
	} else {
		// error
	}

	c.JSON(
		200,
		out,
	)
}

/*
type Response struct{}

type Aggregate struct{}

type AggregateData struct {
	Aggregated []acceptorStructs.Aggregate `json:"aggregated,omitempty"`
}

func (rpc *Aggregate) Receive(req AggregateData, res *acceptorStructs.AggregateResponse) error {
	rows := req.Aggregated
	websocket.NewReports(rows)
	err := base.SaveRows(rows)

	if err == nil {
		res.Ok = true
	} else {
		res.Ok = false
	}
	return err
}


type BlackList struct{}

func (rpc *BlackList) GetAll(req acceptorStructs.BlackListGetParams, res *acceptorStructs.BlackListResponse) error {
	log.WithFields(log.Fields{
		"prefix":       "Handlers",
		"ProviderName": req.ProviderName,
	}).Info("BL GetAll")

	res.Msisdns = base.GetBlackList(req.ProviderName, "")

	//log.Printf("%+v\n", list)

	return nil
}

func (rpc *BlackList) GetNew(req acceptorStructs.BlackListGetParams, res *acceptorStructs.BlackListResponse) error {
	log.WithFields(log.Fields{
		"prefix":       "Handlers",
		"ProviderName": req.ProviderName,
		"Time":         req.Time,
	}).Info("BL GetNew")

	res.Msisdns = base.GetBlackList(req.ProviderName, req.Time)

	//log.Printf("%+v\n", list)

	return nil
}

type Campaigns struct{}

func (rpc *Campaigns) Get(req acceptorStructs.CampaignsGetParams, res *acceptorStructs.CampaignsResponse) error {
	log.WithFields(log.Fields{
		"prefix":   "Handlers",
		"Provider": req.Provider,
	}).Info("Campaigns Get")

	res.Campaigns = base.GetCampaigns(req.Provider)

	//log.Printf("%+v\n", list)

	return nil
}
*/
