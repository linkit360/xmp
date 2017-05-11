package base

import (
	"database/sql"
	"fmt"
	"time"

	log "github.com/Sirupsen/logrus"
	"github.com/linkit360/go-acceptor-structs"
	"github.com/linkit360/go-utils/db"
)

var pgsql *sql.DB
var config db.DataBaseConfig

type Aggregate struct {
	ReportAt     int64  `json:"report_at,omitempty"`
	CampaignId   int64  `json:"id_campaign,omitempty"`
	ProviderName string `json:"provider_name,omitempty"`
	OperatorCode int64  `json:"operator_code,omitempty"`
	LpHits       int64  `json:"lp_hits,omitempty"`
	LpMsisdnHits int64  `json:"lp_msisdn_hits,omitempty"`
	Mo           int64  `json:"mo,omitempty"`
	MoUniq       int64  `json:"mo_uniq,omitempty"`
	MoSuccess    int64  `json:"mo_success,omitempty"`
	RetrySuccess int64  `json:"retry_success,omitempty"`
	Pixels       int64  `json:"pixels,omitempty"`
}

func Init(dbConfig db.DataBaseConfig) {
	config = dbConfig
	pgsql = db.Init(config)
}

func SaveRows(rows []Aggregate) error {
	var query string = fmt.Sprintf(
		"INSERT INTO %sreports ("+

			"report_at, "+
			"id_campaign, "+
			"provider_name, "+
			"operator_code, "+
			"lp_hits, "+
			"lp_msisdn_hits, "+
			"mo, "+
			"mo_uniq, "+
			"mo_success, "+"retry_success, "+
			"pixels"+

			") VALUES ("+

			"to_timestamp($1), $2, $3, $4, $5, $6, $7, $8, $9, $10, $11"+

			");",
		config.TablePrefix)

	var saveCount = 0
	//TODO: make bulk request
	for _, row := range rows {
		if _, err := pgsql.Exec(
			query,
			row.ReportAt,
			row.CampaignId,
			row.ProviderName,
			row.OperatorCode,
			row.LpHits,
			row.LpMsisdnHits,
			row.Mo,
			row.MoUniq,
			row.MoSuccess,
			row.RetrySuccess,
			row.Pixels,
		); err != nil {
			fmt.Println(err.Error())
		}
		saveCount += 1
	}

	//log.WithFields(log.Fields{
	//	"prefix": "Base",
	//}).Info("Reports save: ", saveCount)

	return nil
}

func GetWsData() (map[string]uint64, map[string]string, uint64, uint64, uint64) {
	// widgets
	rows, err := pgsql.Query("SELECT " +
		"SUM(lp_hits) AS LpHits, " +
		"SUM(mo) AS Mo, " +
		"SUM(mo_success) AS MoSuccess " +
		"FROM xmp_reports WHERE " +
		"report_at >= '" + time.Now().Format("2006-01-02") + "'",
	)
	if err != nil {
		log.Fatal(err)
	}
	defer rows.Close()

	var LpHits uint64 = 0
	var Mo uint64 = 0
	var MoSuccess uint64 = 0
	for rows.Next() {
		rows.Scan(
			&LpHits,
			&Mo,
			&MoSuccess,
		)
	}

	// map
	//noinspection SqlResolve
	rows, err = pgsql.Query("SELECT " +
		"c.iso, p.name, p.id " +
		"FROM xmp_providers as p " +
		"INNER JOIN xmp_countries as c " +
		"ON (p.id_country = c.id);",
	)
	if err != nil {
		log.Fatal(err)
	}

	var iso string
	var prov string
	var id uint64

	var provs = map[string]string{}
	for rows.Next() {
		rows.Scan(
			&iso,
			&prov,
			&id,
		)

		provs[prov] = iso
	}

	//fmt.Printf("%+v", provs)

	//noinspection SqlResolve
	rows, err = pgsql.Query("SELECT provider_name, SUM(lp_hits) FROM xmp_reports WHERE report_at >= '" + time.Now().Format("2006-01-02") + "' GROUP BY provider_name")
	if err != nil {
		log.Fatal(err)
	}

	var sum uint64
	var countries = map[string]uint64{}
	for rows.Next() {
		rows.Scan(
			&prov,
			&sum,
		)

		countries[provs[prov]] = sum
	}
	//fmt.Printf("%+v", countries)

	return countries, provs, LpHits, Mo, MoSuccess
}

func GetBlackList(providerName string, time string) []string {
	//noinspection SqlResolve
	rows, err := pgsql.Query("SELECT id FROM xmp_providers WHERE name = '" + providerName + "'")
	if err != nil {
		log.Fatal(err)
	}

	var id string
	for rows.Next() {
		rows.Scan(
			&id,
		)
	}
	//fmt.Printf("%+v", id)

	var data []string
	if id != "" {
		query := "SELECT msisdn FROM xmp_msisdn_blacklist WHERE id_provider = " + id
		if time != "" {
			query = query + " AND created_at >= '" + time + "'"
		}

		//noinspection SqlResolve
		rows, err = pgsql.Query(query)
		if err != nil {
			log.Fatal(err)
		}

		var msisdn string
		for rows.Next() {
			rows.Scan(
				&msisdn,
			)
			data = append(data, msisdn)
		}
	}

	return data
}

func GetCampaigns(provider string) []go_acceptor_structs.CampaignsCampaign {
	rows, err := pgsql.Query("SELECT id FROM xmp_providers WHERE name_alias = '" + provider + "';")
	if err != nil {
		log.Fatal(err)
	}

	var id uint
	for rows.Next() {
		rows.Scan(
			&id,
		)
	}
	//log.Infoln(id)

	data := make([]go_acceptor_structs.CampaignsCampaign, 0)
	if id > 0 {
		var query = fmt.Sprintf("SELECT id FROM xmp_operators WHERE id_provider = %d;", id)
		//log.Infoln(query)

		rows, err := pgsql.Query(query)
		if err != nil {
			log.Fatal(err)
		}

		ids := make([]uint, 0)
		var id uint
		for rows.Next() {
			rows.Scan(
				&id,
			)
			ids = append(ids, id)
		}

		//log.Infoln(ids)

		if len(ids) > 0 {
			query = "SELECT id, title, link, id_lp FROM xmp_campaigns WHERE id_operator IN(0"

			for _, value := range ids {
				query = query + fmt.Sprintf(", %d", value)
			}

			query = query + ");"
			//log.Infoln(query)

			rows, err := pgsql.Query(query)
			if err != nil {
				log.Fatal(err)
			}

			var camp go_acceptor_structs.CampaignsCampaign
			for rows.Next() {
				rows.Scan(
					&camp.Id,
					&camp.Title,
					&camp.Link,
					&camp.Lp,
				)

				//log.Infoln(camp)

				data = append(data, camp)
			}
		}
	}

	//log.Infoln(data)
	return data
}
