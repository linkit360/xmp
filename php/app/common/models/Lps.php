<?php

namespace common\models;

use Yii;
use yii\db\ActiveRecord;

/**
 * @property string  $id
 * @property string  $id_user
 * @property integer $status
 * @property string  $created_at
 * @property string  $updated_at
 */
class Lps extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%lps}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_user'], 'required'],
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

    public function beforeValidate()
    {
        $this->id_user = Yii::$app->user->id;
        return parent::beforeValidate();
    }
}
