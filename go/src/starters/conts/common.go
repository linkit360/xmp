package conts

import (
	"database/sql"
	"encoding/json"
	"fmt"
	"io/ioutil"
	"os/exec"
	"strings"

	_ "github.com/lib/pq"
)

func dbCheck(env string) bool {
	var dbData map[string]string

	// file_get_contents
	dat, err := ioutil.ReadFile("/config/" + env + "/db.json")
	check(err)

	// json_decode
	err = json.Unmarshal(dat, &dbData)
	check(err)

	// Connect
	var connectionString string = "host=" + dbData["host"] +
		" port=5432" +
		" dbname=" + dbData["database"] +
		" user=" + dbData["user"] +
		" password=" + dbData["password"]

	_, err = sql.Open("postgres", connectionString)
	if err != nil {
		fmt.Println("DB ERROR:", err)
		return false
	}

	return true
}

func check(e error) {
	if e != nil {
		panic(e)
	}
}

func run(cmd string) (string, error) {
	command := strings.Split(cmd, " ")
	cmnd := exec.Command(command[0], command[1:]...)
	out, err := cmnd.Output()
	return string(out), err
}
