<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%lp}}".
 *
 * @property string  $id
 * @property string  $id_user
 * @property integer $status
 * @property string  $created_at
 * @property string  $updated_at
 */
class Lp extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%lp}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'id_user'], 'required'],
            [['id', 'id_user'], 'string'],
            [['status'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_user' => 'Id User',
            'status' => 'Status',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }
}
