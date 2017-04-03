package main

import (
	"log"
	"net"
	"net/rpc"
	"net/rpc/jsonrpc"
	"runtime"

	"acceptor/src/base"
	"acceptor/src/config"
	"acceptor/src/handlers"
	"acceptor/src/websocket"
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
	//log.WithField("CPUCount", nuCPU)

	go runGin(appConfig)
	go websocket.Init()
	runRPC(appConfig)
}

func runGin(appConfig config.AppConfig) {
	gin.SetMode(gin.ReleaseMode)
	r := gin.New()
	m.AddHandler(r)

	r.Run(":" + appConfig.Server.HttpPort)
	//log.WithField("port", appConfig.Server.HttpPort).Info("service port")
}

func runRPC(appConfig config.AppConfig) {
	l, err := net.Listen("tcp", "0.0.0.0:" + appConfig.Server.RPCPort)
	if err != nil {
		log.Fatal("netListen ", err.Error())
	}
	log.Println("Main:", "RPC Port:", appConfig.Server.RPCPort)

	server := rpc.NewServer()
	server.HandleHTTP(rpc.DefaultRPCPath, rpc.DefaultDebugPath)
	server.HandleHTTP("/", "/debug")
	server.RegisterName("Aggregate", &handlers.Aggregate{})

	for {
		if conn, err := l.Accept(); err == nil {
			go server.ServeCodec(jsonrpc.NewServerCodec(conn))
		} else {
			log.Println("Main:", "accept", err.Error())
		}
	}
}
