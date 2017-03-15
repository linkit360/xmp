<?php
namespace frontend\models;

use common\models\Reports;
use yii\base\Model;
use yii\data\ActiveDataProvider;

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

        $this->campaigns = $this->operators = $this->providers = [
            0 => 'All',
        ];

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
        $db = Reports::find()
            ->select('DISTINCT ON (id_operator) *')
            ->all();

        /** @var Reports $report */
        foreach ($db as $report) {
            $this->operators[$report->id_operator] = "" . $report->id_operator;
        }
        unset($db);

        # Providers
        $db = Reports::find()
            ->select('DISTINCT ON (id_provider) *')
            ->all();

        /** @var Reports $report */
        foreach ($db as $report) {
            $this->providers[$report->id_provider] = "" . $report->id_provider;
        }
        unset($db);
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
        $query = Reports::find()
            ->orderBy([
                'report_date' => SORT_DESC
            ]);

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
                'report_date >= :date_from'
            )->addParams([
                'date_from' => $this->dateFrom,
            ]);
        }

        # dateTo
        if (substr_count($this->dateTo, '-') > 1) {
            $query->andWhere(
                'report_date < :date_to'
            )->addParams([
                'date_to' => date('Y-m-d', strtotime('+1 day', strtotime($this->dateTo))),
            ]);
        }

//        dump($query->createCommand()->getRawSql());
//        dump($query->all());
        return new ActiveDataProvider([
            'query' => $query,
        ]);

    }
}
