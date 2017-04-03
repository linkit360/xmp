<?php
/**
 * @var \yii\web\View $this
 * @var string        $content
 */

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\Breadcrumbs;

use app\assets\InspiniaAsset;

InspiniaAsset::register($this);

/** @var \common\models\Users $user */
$user = Yii::$app->user->identity;

$this->beginPage();
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?= Html::csrfMetaTags() ?>
    <title><?= strlen($this->title) ? Html::encode($this->title) . ' - ' : '' ?>LinkIT360</title>
    <?php
    $this->head();
    ?>
</head>

<body class="fixed-sidebar md-skin">
<?php
$this->beginBody();
?>
<div id="wrapper">
    <?php
    echo $this->render('sidebar');
    ?>
    <div id="page-wrapper" class="gray-bg">
        <div class="row border-bottom">
            <nav class="navbar navbar-static-top" role="navigation" style="margin-bottom: 0">
                <div class="navbar-header">
                    <a class="navbar-minimalize minimalize-styl-2 btn btn-success" href="#">
                        <i class="fa fa-bars"></i>
                    </a>
                </div>

                <ul class="nav navbar-top-links navbar-right">
                    <li>
                        <a href="<?= Url::toRoute('/site/logout') ?>">
                            <i class="fa fa-sign-out"></i> <?= $user->username ?>
                        </a>
                    </li>
                </ul>
            </nav>
        </div>

        <div class="wrapper wrapper-content animated fadeInRight">
            <div class="row">
                <?= $content ?>
            </div>
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
return;
?>

<!-- Main Wrapper -->
<div id="wrapper">
    <div class="content animate-panel row">
        <div class="hpanel col-lg-12">
            <div class="panel-body">
                <div id="hbreadcrumb" class="pull-right m-t-lg">
                    <?php
                    echo Breadcrumbs::widget([
                        'homeLink' => ['label' => 'XMP', 'url' => '/'],
                        'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
                        'class' => 'hbreadcrumb breadcrumb',
                    ]);
                    ?>
                </div>

                <h2 class="font-light m-b-xs">
                    <?= Html::encode($this->title) ?>
                </h2>

                <small>
                    <?= array_key_exists('subtitle', $this->params) ? $this->params['subtitle'] : '' ?>
                </small>
            </div>
        </div>
        <?= $content ?>
    </div>
</div>
