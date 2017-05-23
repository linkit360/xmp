package main

import (
	"os"

	logr "github.com/Sirupsen/logrus"
	prefixed "github.com/x-cray/logrus-prefixed-formatter"

	"starters/conts"
)

func main() {
	logr.SetFormatter(new(prefixed.TextFormatter))
	logr.SetLevel(logr.DebugLevel)
	log := logr.WithFields(logr.Fields{
		"prefix": "Main",
	})

	// ENV
	var env string = os.Getenv("PROJECT_ENV")
	if env == "" {
		env = "development"
	}

	arg := os.Args[3]
	log.Info("starting '" + arg + "' in " + env)

	if arg == "php" {
		conts.StartPHP(env)
	}

}
