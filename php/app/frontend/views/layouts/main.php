<?php
/**
 * @var \yii\web\View $this
 * @var string        $content
 */

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\Breadcrumbs;

use app\assets\HomerAsset;

HomerAsset::register($this);

/** @var \common\models\Users $user */
$user = Yii::$app->user->identity;

$this->beginPage();
?>
    <!DOCTYPE html>
    <html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <link rel="shortcut icon" type="image/ico" href="/favicon.png"/>
        <?= Html::csrfMetaTags() ?>
        <title><?= strlen($this->title) ? Html::encode($this->title) . ' - ' : '' ?>LinkIT360</title>
        <?php
        $this->head();
        ?>
    </head>
    <body>
    <?php
    $this->beginBody();
    ?>
    <!-- Simple splash screen-->
    <div class="splash">
        <div class="color-line"></div>
        <div class="splash-title">
            <img src="/img/LinkIT360_logo.png"/>
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
    <p class="alert alert-danger">
        You are using an <strong>outdated</strong> browser.
        Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.
    </p>
    <![endif]-->

    <!-- Header -->
    <div id="header">
        <div class="color-line"></div>
        <div id="logo" class="light-version">
            <a href="<?= Url::to('/site/index') ?>">
                <img src="/img/LinkIT360_logo.png" border="0"/>
            </a>
        </div>

        <nav role="navigation">
            <div class="header-link hide-menu"><i class="fa fa-bars"></i></div>
            <div class="small-logo">
                <a href="<?= Url::to('/site/index') ?>">
                    <img src="/img/LinkIT360_logo.png" border="0"/>
                </a>
            </div>

            <!--
            <form role="search" class="navbar-form-custom" method="post" action="#">
                <div class="form-group">
                    <input type="text" placeholder="Search something special" class="form-control" name="search">
                </div>
            </form>

            <div class="mobile-menu">
                <button type="button" class="navbar-toggle mobile-menu-toggle" data-toggle="collapse"
                        data-target="#mobile-collapse">
                    <i class="fa fa-chevron-down"></i>
                </button>
                <div class="collapse mobile-navbar" id="mobile-collapse">
                    <ul class="nav navbar-nav">
                        <li>
                            <a class="" href="#">Link</a>
                        </li>
                        <li>
                            <a class="" href="#">Link</a>
                        </li>
                    </ul>
                </div>
            </div>
            -->

            <div class="navbar-right">
                <ul class="nav navbar-nav no-borders">
                    <li>
                        <h3>
                            <?= $user->username ?>
                        </h3>
                    </li>

                    <li>
                        <a href="<?= Url::toRoute('/site/logout') ?>">
                            <i class="pe-7s-upload pe-rotate-90"></i>
                        </a>
                    </li>
                </ul>
            </div>
        </nav>
    </div>

    <!-- Navigation -->
    <?php
    echo $this->render('sidebar');
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
    <?php
    $this->endBody();
    ?>
    </body>
    </html>
<?php
$this->endPage();
