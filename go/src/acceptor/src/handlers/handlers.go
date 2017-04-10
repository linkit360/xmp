package handlers

import (
	"acceptor/src/base"
	"acceptor/src/websocket"
	log "github.com/Sirupsen/logrus"

	acceptorStructs "github.com/linkit360/go-acceptor-structs"
)

type Response struct{}

type Aggregate struct{}

type AggregateData struct {
	Aggregated []base.Aggregate `json:"aggregated,omitempty"`
}

func (rpc *Aggregate) Receive(req AggregateData, res *Response) error {
	rows := req.Aggregated
	//log.WithFields(log.Fields{
	//	"prefix": "Handlers",
	//}).Info("Receive:", len(rows))
	websocket.NewReports(rows)
	return base.SaveRows(rows)
}

type BlackList struct{}

func (rpc *BlackList) Get(req acceptorStructs.BlackListGetParams, res *acceptorStructs.BlackListResponse) error {
	log.WithFields(log.Fields{
		"prefix":       "Handlers",
		"ProviderName": req.ProviderName,
	}).Info("BL Get")

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
