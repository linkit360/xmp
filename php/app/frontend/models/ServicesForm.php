<?php

namespace frontend\models;

use function array_merge_recursive;
use common\models\Services;

/**
 * Services Form
 */
class ServicesForm extends Services
{
    # Fields
    public $content = [];

    # Data


    /**
     * @inheritdoc
     */
    public function rules()
    {
        return array_merge_recursive(
            parent::rules(),
            [
                [
                    ['content'],
                    'required',
                ],
                [
                    ['content'],
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
                'content' => 'Content',
            ]
        );
    }

    public function beforeValidate()
    {
//        $this->blacklist = json_encode($this->blacklist_tmp);
//        if (array_key_exists('ContentForm', $_FILES) && count($_FILES['ContentForm']['tmp_name'])) {
//            $this->file = true;
//        }

        return parent::beforeValidate();
    }

    /**
     * @param integer $countryId
     */
    public function getContentForm($countryId)
    {


    }
}
