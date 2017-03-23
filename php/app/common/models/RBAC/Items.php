<?php

namespace common\models\RBAC;

use Yii;

/**
 * This is the model class for table "{{%rbac_items}}".
 *
 * @property string            $name
 * @property integer           $type
 * @property string            $description
 * @property string            $rule_name
 * @property resource          $data
 * @property integer           $created_at
 * @property integer           $updated_at
 *
 * @property RbacAssignments[] $rbacAssignments
 * @property RbacRules         $ruleName
 * @property RbacItemsChilds[] $rbacItemsChilds
 * @property RbacItemsChilds[] $rbacItemsChilds0
 * @property Items[]           $children
 * @property Items[]           $parents
 */
class Items extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%rbac_items}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'type'], 'required'],
            [['type', 'created_at', 'updated_at'], 'integer'],
            [['description', 'data'], 'string'],
            [['name', 'rule_name'], 'string', 'max' => 64],
            [
                ['rule_name'],
                'exist',
                'skipOnError' => true,
                'targetClass' => RbacRules::className(),
                'targetAttribute' => ['rule_name' => 'name']
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'name' => 'Name',
            'type' => 'Type',
            'description' => 'Description',
            'rule_name' => 'Rule Name',
            'data' => 'Data',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRbacAssignments()
    {
        return $this->hasMany(RbacAssignments::className(), ['item_name' => 'name']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRuleName()
    {
        return $this->hasOne(RbacRules::className(), ['name' => 'rule_name']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRbacItemsChilds()
    {
        return $this->hasMany(RbacItemsChilds::className(), ['parent' => 'name']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRbacItemsChilds0()
    {
        return $this->hasMany(RbacItemsChilds::className(), ['child' => 'name']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getChildren()
    {
        return $this->hasMany(Items::className(), ['name' => 'child'])->viaTable('{{%rbac_items_childs}}',
            ['parent' => 'name']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getParents()
    {
        return $this->hasMany(Items::className(), ['name' => 'parent'])->viaTable('{{%rbac_items_childs}}',
            ['child' => 'name']);
    }
}
