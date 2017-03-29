<?php
namespace common\models\RBAC;

use yii\db\ActiveRecord;

/**
 * This is the model class for table "{{%rbac_rules}}".
 *
 * @property string   $name
 * @property resource $data
 * @property integer  $created_at
 * @property integer  $updated_at
 *
 * @property Items[]  $rbacItems
 */
class Rules extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%rbac_rules}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['data'], 'string'],
            [['created_at', 'updated_at'], 'integer'],
            [['name'], 'string', 'max' => 64],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'name' => 'Name',
            'data' => 'Data',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRbacItems()
    {
        return $this->hasMany(Items::className(), ['rule_name' => 'name']);
    }
}
