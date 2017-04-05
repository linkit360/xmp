package main

import (
	"net"
	"net/rpc"
	"net/rpc/jsonrpc"
	"runtime"

	"acceptor/src/base"
	"acceptor/src/config"
	"acceptor/src/handlers"
	"acceptor/src/websocket"
	log "github.com/Sirupsen/logrus"
	"github.com/gin-gonic/gin"
	m "github.com/linkit360/go-utils/metrics"
	prefixed "github.com/x-cray/logrus-prefixed-formatter"
)

var appConfig config.AppConfig

func main() {
	log.SetFormatter(new(prefixed.TextFormatter))

	appConfig = config.LoadConfig()

	base.Init(appConfig.DbConf)
	handlers.InitMetrics()

	nuCPU := runtime.NumCPU()
	runtime.GOMAXPROCS(nuCPU)
	//log.WithField("CPUCount", nuCPU)

	go runGin(appConfig)
	go websocket.Init()

	log.WithFields(log.Fields{
		"prefix": "Main",
	}).Info("Init Done")

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
		log.Fatal()

		log.WithFields(log.Fields{
			"prefix": "RPC",
		}).Fatal("netListen ", err.Error())
	}

	log.WithFields(log.Fields{
		"prefix": "RPC",
		"Port":   appConfig.Server.RPCPort,
	}).Info()

	server := rpc.NewServer()
	server.HandleHTTP(rpc.DefaultRPCPath, rpc.DefaultDebugPath)
	server.HandleHTTP("/", "/debug")
	server.RegisterName("Aggregate", &handlers.Aggregate{})
	server.RegisterName("BlackList", &handlers.BlackList{})

	for {
		if conn, err := l.Accept(); err == nil {
			go server.ServeCodec(jsonrpc.NewServerCodec(conn))
		} else {
			log.WithFields(log.Fields{
				"prefix": "RPC",
			}).Info("accept", err.Error())
		}
	}
}
