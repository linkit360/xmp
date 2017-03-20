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
                    'id_provider',
                    'id_operator',
                ],
                'required'
            ],
            [
                [
                    'id_provider',
                    'id_operator'
                ],
                'integer'
            ],
            [['msisdn'], 'string', 'max' => 32],
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
                'id',
            ])
            ->where([
                'status' => 1
            ])
            ->orderBy([
                'name' => SORT_ASC,
            ])
            ->indexBy('id')
            ->column();

        # Providers
        $this->providers = Providers::find()
            ->select([
                'name',
                'id',
                'id_country'
            ])
            ->orderBy([
                'name' => SORT_ASC,
            ])
            ->indexBy('id')
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
            'id_provider' => 'Provider',
            'id_operator' => 'Operator',
            'created_at' => 'Created At',
        ];
    }
}
