<?php

namespace common\models\RBAC;

use Yii;

/**
 * This is the model class for table "{{%rbac_assignments}}".
 *
 * @property string    $item_name
 * @property string    $user_id
 * @property integer   $created_at
 *
 * @property RbacItems $itemName
 */
class Assignments extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%rbac_assignments}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['item_name', 'user_id'], 'required'],
            [['user_id'], 'string'],
            [['created_at'], 'integer'],
            [['item_name'], 'string', 'max' => 64],
            [
                ['item_name'],
                'exist',
                'skipOnError' => true,
                'targetClass' => RbacItems::className(),
                'targetAttribute' => ['item_name' => 'name']
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'item_name' => 'Item Name',
            'user_id' => 'User ID',
            'created_at' => 'Created At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getItemName()
    {
        return $this->hasOne(RbacItems::className(), ['name' => 'item_name']);
    }
}
