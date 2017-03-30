package main

import (
	"net"
	"net/rpc"
	"net/rpc/jsonrpc"
	"runtime"

	"acceptor/src/base"
	"acceptor/src/config"
	"acceptor/src/handlers"
	log "github.com/Sirupsen/logrus"
	"github.com/gin-gonic/gin"
	m "github.com/linkit360/go-utils/metrics"
)

var appConfig config.AppConfig

func main() {
	appConfig = config.LoadConfig()

	base.Init(appConfig.DbConf)
	handlers.InitMetrics()

	nuCPU := runtime.NumCPU()
	runtime.GOMAXPROCS(nuCPU)
	log.WithField("CPUCount", nuCPU)

	go runGin(appConfig)
	runRPC(appConfig)
}

func runGin(appConfig config.AppConfig) {
	r := gin.New()
	m.AddHandler(r)
	r.Run(":" + appConfig.Server.HttpPort)
	log.WithField("port", appConfig.Server.HttpPort).Info("service port")
}

func runRPC(appConfig config.AppConfig) {
	l, err := net.Listen("tcp", "0.0.0.0:"+appConfig.Server.RPCPort)
	if err != nil {
		log.Fatal("netListen ", err.Error())
	}
	log.WithField("port", appConfig.Server.RPCPort).Info("rpc port")

	server := rpc.NewServer()
	server.HandleHTTP(rpc.DefaultRPCPath, rpc.DefaultDebugPath)
	server.RegisterName("Aggregate", &handlers.Aggregate{})

	for {
		if conn, err := l.Accept(); err == nil {
			go server.ServeCodec(jsonrpc.NewServerCodec(conn))
		} else {
			log.WithField("error", err.Error()).Error("accept")
		}
	}
}
