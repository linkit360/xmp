<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%campaigns}}".
 *
 * @property string  $id
 * @property string  $id_user
 * @property string  $title
 * @property string  $description
 * @property string  $link
 * @property integer $flow_type
 * @property integer $status
 * @property string  $created_at
 * @property string  $updated_at
 */
class Campaigns extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%campaigns}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'id_user', 'title', 'link'], 'required'],
            [['id', 'id_user'], 'string'],
            [['flow_type', 'status'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['title'], 'string', 'max' => 128],
            [['description'], 'string', 'max' => 255],
            [['link'], 'string', 'max' => 64],
            [['link'], 'unique'],
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
            'title' => 'Title',
            'description' => 'Description',
            'link' => 'Link',
            'flow_type' => 'Flow Type',
            'status' => 'Status',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }
}
