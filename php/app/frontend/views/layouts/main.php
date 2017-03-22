<?php
/**
 * @var \yii\web\View $this
 * @var string        $content
 */

use yii\helpers\Html;
use app\assets\HomerAsset;
use yii\helpers\Url;

HomerAsset::register($this);
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
    <p class="alert alert-danger">
        You are using an <strong>outdated</strong> browser.
        Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.
    </p>
    <![endif]-->

    <!-- Header -->
    <div id="header">
        <div class="color-line"></div>

        <div id="logo" class="light-version">
            <!--            <span><a href="/"><img src="/img/LinkIT360_logo.png"/></a></span>-->
            <span><a href="<?= Url::to('/site/index') ?>">LinkIT 360</a></span>
        </div>

        <nav role="navigation">
            <div class="header-link hide-menu"><i class="fa fa-bars"></i></div>
            <div class="small-logo">
                <span class="text-primary">LinkIT 360</span>
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
                        <a href="<?= Url::toRoute('/site/logout') ?>">
                            <i class="pe-7s-upload pe-rotate-90"></i>
                        </a>
                    </li>
                </ul>
            </div>
        </nav>
    </div>

    <!-- Navigation -->
    <?= $this->render('sidebar') ?>

    <!-- Main Wrapper -->
    <div id="wrapper">
        <?php
        //                echo Breadcrumbs::widget([
        //                    'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        //                ]);

        echo $content;
        ?>
    </div>
    <?php
    $this->endBody();
    ?>
    </body>
    </html>
<?php
$this->endPage();
