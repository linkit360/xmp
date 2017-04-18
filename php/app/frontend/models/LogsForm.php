<?php

namespace frontend\models;

use common\models\Logs;
use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * Logs Form
 */
class LogsForm extends Model
{

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
        $query = Logs::find()
            ->with([
                'user',
            ])
            ->select([

            ])
            ->orderBy([
                'time' => SORT_DESC,
            ]);

        return new ActiveDataProvider([
            'query' => $query,
        ]);
    }
}
