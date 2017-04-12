<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%services}}".
 *
 * @property string  $id
 * @property string  $title
 * @property string  $description
 * @property integer $id_provider
 * @property string  $id_user
 * @property integer $status
 * @property string  $created_at
 * @property string  $updated_at
 */
class Services extends \yii\db\ActiveRecord
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
            [['id', 'title', 'id_provider', 'id_user'], 'required'],
            [['id', 'id_user'], 'string'],
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
}
