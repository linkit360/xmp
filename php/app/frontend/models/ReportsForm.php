<?php
namespace frontend\models;

use common\models\Countries;
use common\models\Operators;
use common\models\Providers;
use common\models\Reports;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use yii\db\Query;

/**
 * Reports Form
 */
class ReportsForm extends Model
{
    # Fields
    public $country;
    public $operator;
    public $provider;
    public $campaign;

    public $dateFrom;
    public $dateTo;

    # Data
    public $countries = [];
    public $operators = [];
    public $providers = [];
    public $campaigns = [];

    public function init()
    {
        $this->dateFrom = date('Y-m-d');
        $this->dateTo = date('Y-m-d');

        $this->campaigns = [
            0 => 'All',
        ];

        # Countries
        $this->countries = [0 => 'All'] +
            Countries::find()
                ->select([
                    'name',
                    'code'
                ])
                ->where([
                    'status' => 1
                ])
                ->orderBy([
                    'name' => SORT_ASC,
                ])
                ->indexBy('code')
                ->column();


        # Campaigns
        $db = Reports::find()
            ->select('DISTINCT ON (id_campaign) *')
            ->all();

        /** @var Reports $report */
        foreach ($db as $report) {
            $this->campaigns[$report->id_campaign] = "" . $report->id_campaign;
        }
        unset($db);

        # Operators
        $this->operators = [0 => 'All'] +
            Operators::find()
                ->select([
                    'name',
                    'code',
                ])
                ->where([
                    'status' => 1
                ])
                ->orderBy([
                    'name' => SORT_ASC,
                ])
                ->indexBy('code')
                ->column();

        # Providers
        $this->providers = [0 => 'All'] +
            Providers::find()
                ->select([
                    'name',
                    'name_alias',
                ])
                ->orderBy([
                    'name' => SORT_ASC,
                ])
                ->indexBy('name_alias')
                ->column();
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [
                [
                    'campaign',
                    'operator',
                    'provider',
                    'country',

                    'dateFrom',
                    'dateTo',
                ],
                'string'
            ],

        ];
    }

    /**
     * @return ActiveDataProvider
     */
    public function dataProvider()
    {
        $query = (new Query())
            ->from('xmp_reports')
            ->select([
                'SUM(lp_hits) as lp_hits',
                'SUM(lp_msisdn_hits) as lp_msisdn_hits',
                'SUM(mo) as mo',
                'SUM(mo_uniq) as mo_uniq',
                'SUM(mo_success) as mo_success',
                'SUM(pixels) as pixels',

                "date_trunc('day', report_at) as report_at_day",
                'id_campaign',
                'provider_name',
                'operator_code',
            ])
            ->groupBy([
                'report_at_day',
                'id_campaign',
                'provider_name',
                'operator_code',
            ])
            ->orderBy([
                'report_at_day' => SORT_DESC
            ]);

        // TODO Country
        // TODO IDs

        if ($this->campaign !== null && $this->campaign !== "0") {
            $query->andWhere([
                'id_campaign' => $this->campaign,
            ]);
        }

        if ($this->provider !== null && $this->provider !== "0") {
            $query->andWhere([
                'id_provider' => $this->provider,
            ]);
        }

        if ($this->operator !== null && $this->operator !== "0") {
            $query->andWhere([
                'id_operator' => $this->operator,
            ]);
        }

        # dateFrom
        if (substr_count($this->dateFrom, '-') > 1) {
            $query->andWhere(
                'report_at >= :date_from'
            )->addParams([
                'date_from' => $this->dateFrom,
            ]);
        }

        # dateTo
        if (substr_count($this->dateTo, '-') > 1) {
            $query->andWhere(
                'report_at < :date_to'
            )->addParams([
                'date_to' => date('Y-m-d', strtotime('+1 day', strtotime($this->dateTo))),
            ]);
        }

//        dump($query->createCommand()->getRawSql());
//        dump($query->all());
//        die;

        return new ActiveDataProvider([
            'query' => $query,
        ]);
    }
}
