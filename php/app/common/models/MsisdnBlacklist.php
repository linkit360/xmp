<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "xmp_msisdn_blacklist".
 *
 * @property integer $id
 * @property string  $msisdn
 * @property string  $provider_name
 * @property integer $operator_code
 * @property string  $created_at
 */
class MsisdnBlacklist extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'xmp_msisdn_blacklist';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['provider_name', 'operator_code'], 'required'],
            [['operator_code'], 'integer'],
            [['created_at'], 'safe'],
            [['msisdn'], 'string', 'max' => 32],
            [['provider_name'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'msisdn' => 'Msisdn',
            'provider_name' => 'Provider Name',
            'operator_code' => 'Operator Code',
            'created_at' => 'Created At',
        ];
    }
}
