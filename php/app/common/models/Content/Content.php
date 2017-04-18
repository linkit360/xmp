<?php

namespace common\models\Content;

use Yii;
use yii\db\ActiveRecord;

use common\helpers\LogsHelper;

/**
 * @property string  $id
 * @property string  $id_user
 * @property string  $id_category
 * @property string  $id_publisher
 * @property string  $title
 * @property integer $status
 * @property string  $time_create
 */
class Content extends ActiveRecord
{
    private $categories = [];
    private $publishers = [];

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%content}}';
    }

    public function getCategories()
    {
        if (!count($this->categories)) {
            $this->categories = Categories::find()
                ->select([
                    'title',
                    'id',
                ])
                ->where([
                    'status' => 1,
                ])
                ->orderBy([
                    'title' => SORT_ASC,
                ])
                ->indexBy('id')
                ->column();
        }

        return $this->categories;
    }

    public function getPublishers()
    {
        if (!count($this->publishers)) {
            $this->publishers = Publishers::find()
                ->select([
                    'title',
                    'id',
                ])
                ->where([
                    'status' => 1,
                ])
                ->orderBy([
                    'title' => SORT_ASC,
                ])
                ->indexBy('id')
                ->column();
        }

        return $this->publishers;
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_user', 'id_category', 'title'], 'required'],
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
            'id_user' => 'User',
            'id_category' => 'Category',
            'id_publisher' => 'Publisher',
            'title' => 'Title',
            'status' => 'Status',
            'time_create' => 'Added',
        ];
    }

    public function beforeValidate()
    {
        $this->id_user = Yii::$app->user->id;
        return parent::beforeValidate();
    }

    public function afterSave($insert, $oldAttributes)
    {
        $logs = new LogsHelper();
        $logs->log(
            $this,
            $oldAttributes
        );

        return parent::afterSave(
            $insert,
            $oldAttributes
        );
    }
}
