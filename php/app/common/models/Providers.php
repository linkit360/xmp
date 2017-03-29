<?php
namespace common\models;

use yii\db\ActiveRecord;

/**
 * This is the model class for table "xmp_providers".
 *
 * @property integer $id
 * @property string  $name
 * @property integer $id_country
 */
class Providers extends ActiveRecord
{
    private $countries = [];

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%providers}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'id_country'], 'required'],
            [['id_country'], 'integer'],
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
            'id_country' => 'Country',
        ];
    }

    public function getCountries()
    {
        if (!count($this->countries)) {
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
        }

        return $this->countries;
    }
}
