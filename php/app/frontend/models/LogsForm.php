<?php

namespace frontend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use yii\db\Query;

/**
 * Logs Form
 */
class LogsForm extends Model
{
    # Fields
//    public $msisdn;
//    public $date;
//    public $country;

    # Data
//    public $countries = [];

    public function init()
    {

    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [
                [
                    'msisdn',
                    'country',
                    'date',
                ],
                'string',
            ],

        ];
    }

    /**
     * @return ActiveDataProvider
     */
    public function dataProvider()
    {
        $query = (new Query())
            ->from('xmp_logs')
            ->select([

            ])
            ->orderBy([
                'time' => SORT_DESC,
            ]);


//        dump($query->createCommand()->getRawSql());
//        dump($query->all());
//        die;

        return new ActiveDataProvider([
            'query' => $query,
        ]);
    }
}
