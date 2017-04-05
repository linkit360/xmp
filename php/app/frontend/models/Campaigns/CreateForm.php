<?php

namespace frontend\models\Campaigns;

use common\models\Campaigns;
use function count;
use yii\base\Model;
use common\models\Operators;
use yii\helpers\ArrayHelper;

/**
 * Reports Form
 */
class CreateForm extends Model
{
    # Fields
    public $title;
    public $description;
    public $link;
    public $id_service;
    public $id_operator;
    public $status;

    # Data
    public $operators = [];

    public function init()
    {
//        $this->dateFrom = date('Y-m-d');
//        $this->dateTo = date('Y-m-d');
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [
                [
                    'title',
                    'description',
                    'link',
                    'id_service',
                    'id_operator',
                    'status',
                ],
                'required',
            ],
            [
                [
                    'title',
                    'description',
                    'link',
                    'id_service',
                ],
                'string',
            ],
            [
                [
                    'status',
                ],
                'integer',
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_service' => 'Service',
            'id_operator' => 'Operator',
            'title' => 'Title',
            'description' => 'Description',
            'link' => 'Link',
            'status' => 'Status',
        ];
    }

    # Operators
    public function getOperators()
    {
        if (!count($this->operators)) {
            $data = Operators::find()
                ->select([
                    'name',
                    'id',
                ])
                ->where([
                    'status' => 1,
                ])
                ->orderBy([
                    'name' => SORT_ASC,
                ])
                ->asArray()
                ->indexBy('id')
                ->all();

            $this->operators = ArrayHelper::map(
                $data,
                'id',
                'name'
            );
        }

        return $this->operators;
    }

    public function create()
    {
        if (!$this->validate()) {
            return null;
        }

        $campaign = new Campaigns();
        $campaign->load($this->attributes, '');
        $campaign->save();
        return $campaign->save() ? $campaign : null;
    }
}
