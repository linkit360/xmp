package handlers

import (
	"acceptor/src/base"
	"acceptor/src/websocket"
	log "github.com/Sirupsen/logrus"
)

func init() {
	log.SetLevel(log.DebugLevel)
}

type Response struct{}

type Aggregate struct{}

type AggregateData struct {
	Aggregated []base.Aggregate `json:"aggregated,omitempty"`
}

func (rpc *Aggregate) Receive(req AggregateData, res *Response) error {
	rows := req.Aggregated
	log.Infoln("Receive: ", len(rows))
	websocket.LpHitsToday(rows)
	return base.SaveRows(rows)
}

func (rpc *Aggregate) ReceiveTest(req interface{}, res *Response) error {
	log.Infoln(req)
	return nil
}

type BlackList struct{}

type BlackListParams struct {
	ProviderName string `json:"provider_name,omitempty"`
}

type BlackListResponse struct {
	Msisdns []string `json:"msisdns,omitempty"`
}

func (rpc *BlackList) Get(req BlackListParams, res *BlackListResponse) error {
	return nil
}
