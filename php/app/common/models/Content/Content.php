<?php

namespace common\models\Content;

use Yii;

/**
 * This is the model class for table "{{%content}}".
 *
 * @property string  $id
 * @property string  $id_user
 * @property string  $id_category
 * @property string  $id_publisher
 * @property string  $title
 * @property integer $status
 * @property string  $time_create
 */
class Content extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%content}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'id_user', 'id_category', 'title'], 'required'],
            [['id', 'id_user', 'id_category', 'id_publisher'], 'string'],
            [['status'], 'integer'],
            [['time_create'], 'safe'],
            [['title'], 'string', 'max' => 32],
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
            'id_category' => 'Id Category',
            'id_publisher' => 'Id Publisher',
            'title' => 'Title',
            'status' => 'Status',
            'time_create' => 'Time Create',
        ];
    }
}
