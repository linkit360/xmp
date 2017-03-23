<?php
namespace frontend\models;

use Yii;
use yii\base\Model;

/**
 * Rbac Role Form
 */
class RbacForm extends Model
{
    # Fields
    public $name;
    public $description;
    public $isNewRecord = true;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [
                [
                    'name',
                    'description',
                ],
                'string'
            ],
            [
                [
                    'name',
                    'description',
                ],
                'required'
            ],
        ];
    }

    public function save()
    {
        if ($this->validate()) {
            $auth = Yii::$app->authManager;
            if ($auth->getRole($this->name) !== null) {
                $this->addError('name', 'Role already exists.');
                return false;
            }
            $role = $auth->createRole($this->name);
            $role->description = $this->description;
            return $auth->add($role);
        }
        return false;
    }
}
