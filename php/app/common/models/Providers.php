<?php
namespace common\models;

use yii\db\ActiveRecord;

/**
 * This is the model class for table "xmp_providers".
 *
 * @property integer $id
 * @property string  $name
 * @property array   $countries
 * @property integer $country
 */
class Providers extends ActiveRecord
{
    private $countries = [];

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'xmp_providers';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'country'], 'required'],
            [['country'], 'integer'],
            [['name'], 'string', 'max' => 255],
            [['name'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'country' => 'Country',
        ];
    }

    public function getCountries()
    {
        if (!count($this->countries)) {
            $this->countries = Countries::find()
                ->select([
                    'name',
                    'code'
                ])
                ->where([
                    'status' => 1
                ])
                ->indexBy('code')
                ->column();
        }

        return $this->countries;
    }
}
