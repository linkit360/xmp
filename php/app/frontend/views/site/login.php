<?php

/**
 * @var $this  yii\web\View
 * @var $form  yii\bootstrap\ActiveForm
 * @var $model \common\models\LoginForm
 */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use app\assets\InspiniaAsset;

$this->title = 'Login';
$this->params['breadcrumbs'][] = $this->title;
InspiniaAsset::register($this);
?>
    <!DOCTYPE html>
    <html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>INSPINIA | Login</title>
        <?= Html::csrfMetaTags() ?>
        <title><?= strlen($this->title) ? Html::encode($this->title) . ' - ' : '' ?>LinkIT360</title>
        <?php
        $this->head();
        ?>
    </head>

    <body class="gray-bg">
    <?php
    $this->beginBody();
    ?>
    <div class="middle-box text-center loginscreen animated fadeInDown">
        <div>
            <h1 class="logo-name">
                XMP
            </h1>
            <?php
            $form = ActiveForm::begin(['id' => 'login-form']);
            echo $form->field($model, 'username')->textInput(['autofocus' => true]);
            echo $form->field($model, 'password')->passwordInput();
            ?>

            <div class="form-group">
                <?php
                echo Html::submitButton('Login',
                    [
                        'class' => 'btn btn-success btn-block',
                        'name' => 'login-button',
                    ]
                );
                ?>
            </div>

            <?php
            ActiveForm::end();
            ?>
        </div>
    </div>

    <?php
    $this->endBody();
    ?>
    </body>
    </html>
<?php
$this->endPage();
