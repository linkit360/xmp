<?php

namespace frontend\models\Users;

use function array_keys;
use common\models\Users;
use function is_array;
use Yii;
use yii\base\Model;
use yii\rbac\ManagerInterface;
use yii\rbac\Role;

/**
 * Update User Form
 *
 * @property array            $roles
 * @property array            $rolesAll
 * @property array            $permissionsAll
 * @property Users            $user
 * @property ManagerInterface $auth
 */
class UpdateForm extends Model
{
    # Fields
    public $roles;
    public $user;

    # Data
    private $rolesAll = [];
    private $auth;

    public function init()
    {
        $this->auth = Yii::$app->authManager;
    }

    public function set($id)
    {
        $this->user = Users::findOne($id);
        $this->roles = array_keys($this->auth->getRolesByUser($this->user->id));
    }

    public function rules()
    {
        return [
            [
                [
                    'roles',
                ],
                'trim'
            ],
        ];
    }

    public function save()
    {
        if (!$this->validate()) {
            return null;
        }

        // Remove all roles
        $this->auth->revokeAll($this->user->id);

        // Add roles from form
        if (is_array($this->roles) && count($this->roles)) {
            foreach ($this->roles as $role) {
                $role = $this->auth->getRole($role);
                if ($role) {
                    $this->auth->assign($role, $this->user->id);
                }
            }
        }

        return true;
    }

    public function getRolessAll()
    {
        if (!count($this->rolesAll)) {
            $roles = [];
            /** @var Role $role */
            foreach ($this->auth->getRoles() as $role) {
                $roles[$role->name] = $role->name . ' - ' . $role->description;
            }
            $this->rolesAll = $roles;
        }

        return $this->rolesAll;
    }
}