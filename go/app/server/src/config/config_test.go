package config

import (
	"io/ioutil"
	"testing"

	"github.com/jinzhu/configor"
	"github.com/stretchr/testify/assert"
	yaml "gopkg.in/yaml.v2"
)

func TestConfig(t *testing.T) {
	var appConfigConfigor AppConfig
	envConfigPath := "../../dev/acceptor.dev.yml"

	err := configor.Load(&appConfigConfigor, envConfigPath)
	assert.NoError(t, err, "configor load")

	data, err := ioutil.ReadFile(envConfigPath)
	assert.NoError(t, err, "ioutil.ReadFile load data")

	var appConfigCYaml2 AppConfig
	err = yaml.Unmarshal(data, &appConfigCYaml2)
	assert.NoError(t, err, "yaml.Unmarshal error")

	if !assert.ObjectsAreEqual(appConfigCYaml2, appConfigConfigor) {
		assert.Equal(t, appConfigCYaml2, appConfigConfigor, "configs differ")
	}

}
