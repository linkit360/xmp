<?php
namespace common\models\RBAC;

use yii\db\ActiveRecord;

/**
 * This is the model class for table "{{%rbac_items_childs}}".
 *
 * @property string $parent
 * @property string $child
 *
 * @property Items  $parent0
 * @property Items  $child0
 */
class ItemsChilds extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%rbac_items_childs}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['parent', 'child'], 'required'],
            [['parent', 'child'], 'string', 'max' => 64],
            [
                ['parent'],
                'exist',
                'skipOnError' => true,
                'targetClass' => Items::className(),
                'targetAttribute' => ['parent' => 'name']
            ],
            [
                ['child'],
                'exist',
                'skipOnError' => true,
                'targetClass' => Items::className(),
                'targetAttribute' => ['child' => 'name']
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'parent' => 'Parent',
            'child' => 'Child',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getParent0()
    {
        return $this->hasOne(Items::className(), ['name' => 'parent']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getChild0()
    {
        return $this->hasOne(Items::className(), ['name' => 'child']);
    }
}
