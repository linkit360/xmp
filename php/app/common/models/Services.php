<?php

namespace common\models;

use Yii;
use yii\db\ActiveRecord;

/**
 * @property string  $id
 * @property string  $title
 * @property string  $description
 * @property integer $id_provider
 * @property string  $id_user
 * @property integer $status
 * @property string  $created_at
 * @property string  $updated_at
 */
class Services extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%services}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title', 'id_provider', 'id_user'], 'required'],
            [['id_user'], 'string'],
            [['id_provider', 'status'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['title'], 'string', 'max' => 64],
            [['description'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Title',
            'description' => 'Description',
            'id_provider' => 'Id Provider',
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
