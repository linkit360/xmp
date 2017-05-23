package conts

import (
	"fmt"
	"time"

	logr "github.com/Sirupsen/logrus"
	prefixed "github.com/x-cray/logrus-prefixed-formatter"
)

func StartPHP(env string) {
	logr.SetFormatter(new(prefixed.TextFormatter))
	logr.SetLevel(logr.DebugLevel)
	log := logr.WithFields(logr.Fields{
		"prefix": "PHP",
	})

	// DB Check
	var retry int = 0
	for !dbCheck(env) {
		retry += 1
		time.Sleep(time.Second * 2)
		if retry > 2 {
			panic("DB FATAL")
		}
	}

	log.Info("DB OK")

	// Migrations
	log.Info("Migrations")
	out, err := run("php /app/yii migrate/up --interactive=0")
	if err != nil {
		fmt.Println("Error: ", err)
		fmt.Println("Out: ", out)
		return
	}
	log.Debug(out)
	log.Info("Migrations OK")

	/*
		// PHP
		out, err = run("php-fpm --fpm-config=/usr/local/etc/php-fpm.conf")
		if err != nil {
			fmt.Println("Error: ", err)
			fmt.Println("Out: ", out)
			return
		}

		log.WithFields(log.Fields{
			"prefix": "Main",
		}).Info("PHP FPM")
	*/

}
