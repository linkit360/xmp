<?php

namespace common\models;

use Yii;
use yii\db\ActiveRecord;

/**
 * @property string  $id
 * @property string  $title
 * @property string  $description
 * @property integer $id_provider
 * @property integer $id_service
 * @property string  $service_opts
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
            [['title', 'id_user', 'id_provider', 'id_service', 'service_opts'], 'required'],
            [['id', 'id_user', 'service_opts'], 'string'],
            [['id_provider', 'status'], 'integer'],
            [['updated_at', 'created_at'], 'safe'],
            [['title', 'id_service'], 'string', 'max' => 64],
            [['description'], 'string', 'max' => 255],
            [
                [
                    'id_provider',
                    'id_service',
                ],
                'unique',
                'targetAttribute' => [
                    'id_provider',
                    'id_service',
                ],
                'message' => 'The combination of Provider and Service ID has already been taken.',
            ],
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
            'id_provider' => 'Provider',
            'id_user' => 'User ID',
            'status' => 'Status',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'id_service' => 'Service ID',
        ];
    }

    public function beforeValidate()
    {
        $this->id_user = Yii::$app->user->id;
        return parent::beforeValidate();
    }
}
