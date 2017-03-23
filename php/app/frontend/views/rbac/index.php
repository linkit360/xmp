<?php

use yii\helpers\Html;

/**
 * @var yii\web\View $this
 * @var array        $data
 */

$this->title = 'RBAC';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="content animate-panel">
    <div class="row">
        <div class="col-lg-12">
            <div class="hpanel">
                <div class="panel-body">
                    <h2 class="font-light m-b-xs">
                        Role Based Access Control (RBAC)
                    </h2>
                    <small>Roles and Permissions</small>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-6">
            <div class="hpanel">
                <div class="panel-body">
                    <h1>
                        Roles
                        <small><?= Html::a('Create Role', ['create'], ['class' => 'btn btn-success btn-xs']) ?></small>
                    </h1>

                    <table class="table table-condensed">
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
        </div>

        <div class="col-lg-6">
            <div class="hpanel">
                <div class="panel-body">
                    <h1>
                        Permissions
                    </h1>

                    <table class="table table-condensed">
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
        </div>
    </div>
</div>
