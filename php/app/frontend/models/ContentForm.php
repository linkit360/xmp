<?php

namespace frontend\models;

use function array_merge_recursive;
use common\models\Countries;
use common\models\Content\Content;
use common\models\Content\Categories;
use common\models\Content\Publishers;
use function json_encode;

/**
 * Content Form
 */
class ContentForm extends Content
{
    # Fields
    public $blacklist_tmp = [];

    # Data
    private $categories = [];
    private $publishers = [];
    private $countries = [];

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return array_merge_recursive(
            parent::rules(),
            [
                [
                    'blacklist_tmp',
                    'safe',
                ],
            ]
        );
    }

    public function attributeLabels()
    {
        return array_merge_recursive(
            parent::attributeLabels(),
            [
                'blacklist_tmp' => 'Blacklist Countries',
            ]
        );
    }

    public function beforeValidate()
    {
        $this->blacklist = json_encode($this->blacklist_tmp);
        return parent::beforeValidate();
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

    public function getCountries()
    {
        if (!count($this->countries)) {
            $this->countries = Countries::find()
                ->select([
                    'name',
                    'id',
                ])
                ->where([
                    'status' => 1,
                ])
                ->orderBy([
                    'name' => SORT_ASC,
                ])
                ->indexBy('id')
                ->column();
        }

        return $this->countries;
    }
}