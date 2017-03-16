<?php
namespace common\models;

/**
 * This is the model class for table "xmp_countries".
 *
 * @property integer $id
 * @property string  $name
 * @property integer $code
 * @property integer $status
 * @property string  $iso
 * @property integer $priority
 */
class Countries extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'xmp_countries';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'code', 'status', 'iso', 'priority'], 'required'],
            [['code', 'status', 'priority'], 'integer'],
            [['name'], 'string', 'max' => 255],
            [['iso'], 'string', 'max' => 32],
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
            'code' => 'Code',
            'status' => 'Status',
            'iso' => 'Iso',
            'priority' => 'Priority',
        ];
    }
}
