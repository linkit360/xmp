<?php

namespace frontend\models\Services;

use yii\base\Model;

class CheeseForm extends Model
{
    # Fields
    public $price;

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
                    'price',
                ],
                'required',
            ],
            [
                [
                    'price',
                ],
                'integer',
            ],

        ];
    }
}
