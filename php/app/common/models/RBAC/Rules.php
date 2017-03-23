<?php

namespace common\models\RBAC;

use Yii;

/**
 * This is the model class for table "{{%rbac_rules}}".
 *
 * @property string      $name
 * @property resource    $data
 * @property integer     $created_at
 * @property integer     $updated_at
 *
 * @property RbacItems[] $rbacItems
 */
class Rules extends \yii\db\ActiveRecord
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
        return $this->hasMany(RbacItems::className(), ['rule_name' => 'name']);
    }
}
