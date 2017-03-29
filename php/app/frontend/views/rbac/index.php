<?php

use yii\helpers\Html;

/**
 * @var yii\web\View $this
 * @var array        $data
 */

$this->title = 'RBAC';
$this->params['subtitle'] = 'Role Based Access Control, Roles and Permissions';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="hpanel col-lg-6">
    <div class="panel-body">
        <h1>
            Roles
            <?= Html::a('Create Role', ['create'], ['class' => 'btn btn-success btn-sm']) ?>
        </h1>

        <table class="table table-condensed">
            <tr>
                <th style="width: 1%;">Name</th>
                <th>Description</th>
            </tr>

            <?php
            /** @var \yii\rbac\Role $role */
            foreach ($data['roles'] as $role) {
                ?>
                <tr>
                    <td>
                        <?php
                        echo Html::a(
                            Html::encode($role->name),
                            '/rbac/view?id=' . $role->name
                        );
                        ?>
                    </td>

                    <td>
                        <?= nl2br(Html::encode($role->description)) ?>
                    </td>
                </tr>
                <?php
            }
            ?>
        </table>
    </div>
</div>

<div class="hpanel col-lg-6">
    <div class="panel-body">
        <h1>
            Permissions
        </h1>

        <table class="table table-condensed">
            <tr>
                <th style="width: 1%;">Name</th>
                <th>Description</th>
            </tr>

            <?php
            /** @var \yii\rbac\Permission $perm */
            foreach ($data['permissions'] as $perm) {
                ?>
                <tr>
                    <td>
                        <?= Html::encode($perm->name) ?>
                    </td>

                    <td>
                        <?= nl2br(Html::encode($perm->description)) ?>
                    </td>
                </tr>
                <?php
            }
            ?>
        </table>
    </div>
</div>
