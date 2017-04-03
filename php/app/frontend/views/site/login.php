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
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <?= Html::csrfMetaTags() ?>
        <title><?= strlen($this->title) ? Html::encode($this->title) . ' - ' : '' ?>LinkIT360</title>
        <?php
        $this->head();
        ?>
    </head>
    <body class="blank">
    <?php
    $this->beginBody();
    ?>
    <!-- Simple splash screen-->
    <div class="splash">
        <div class="color-line"></div>
        <div class="splash-title"><h1>LinkIT 360</h1>
            <p>
                XMP
            </p>

            <div class="spinner">
                <div class="rect1"></div>
                <div class="rect2"></div>
                <div class="rect3"></div>
                <div class="rect4"></div>
                <div class="rect5"></div>
            </div>
        </div>
    </div>
    <!--[if lt IE 7]>
    <p class="alert alert-danger">You are using an <strong>outdated</strong> browser. Please <a
            href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
    <![endif]-->

    <div class="color-line"></div>
    <div class="login-container">
        <div class="text-center m-b-md">
            <h3>LOGIN</h3>
        </div>

        <div class="hpanel">
            <div class="panel-body">
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
                            'name' => 'login-button'
                        ]
                    );
                    ?>
                </div>

                <?php
                ActiveForm::end();
                ?>
            </div>
        </div>
    </div>
    <?php
    $this->endBody();
    ?>
    </body>
    </html>
<?php
$this->endPage();
