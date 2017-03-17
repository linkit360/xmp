<?php
namespace common\models;

use yii\db\ActiveRecord;

/**
 * This is the model class for table "xmp_msisdn_blacklist".
 *
 * @property integer $id
 * @property string  $msisdn
 * @property string  $provider_name
 * @property integer $operator_code
 * @property string  $created_at
 */
class MsisdnBlacklist extends ActiveRecord
{
    # Data
    public $countries = [];
    public $operators = [];
    public $providers = [];

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
            [
                [
                    'msisdn',
                    'provider_name',
                    'operator_code',
                ],
                'required'
            ],
            [['operator_code'], 'integer'],
            [['msisdn'], 'string', 'max' => 32],
            [['provider_name'], 'string', 'max' => 255],
        ];
    }

    public function init()
    {
        # Countries
        $this->countries = Countries::find()
            ->select([
                'name',
                'id'
            ])
            ->where([
                'status' => 1
            ])
            ->orderBy([
                'name' => SORT_ASC,
            ])
            ->indexBy('id')
            ->column();

        # Operators
        $this->operators = Operators::find()
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
        $this->providers = Providers::find()
            ->select([
                'name',
                'name_alias',
                'id_country'
            ])
            ->orderBy([
                'name' => SORT_ASC,
            ])
            ->indexBy('name_alias')
            ->all();
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'msisdn' => 'MSISDN',
            'provider_name' => 'Provider',
            'operator_code' => 'Operator',
            'created_at' => 'Created At',
        ];
    }
}
