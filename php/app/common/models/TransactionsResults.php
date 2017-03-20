<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "xmp_transactions_results".
 *
 * @property string            $name
 *
 * @property XmpTransactions[] $xmpTransactions
 */
class TransactionsResults extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'xmp_transactions_results';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['name'], 'string', 'max' => 127],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'name' => 'Name',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getXmpTransactions()
    {
        return $this->hasMany(XmpTransactions::className(), ['result' => 'name']);
    }
}
