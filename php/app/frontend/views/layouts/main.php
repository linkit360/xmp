<?php
/**
 * @var \yii\web\View $this
 * @var string        $content
 */

use yii\helpers\Html;

//AltairAsset::register($this);
$this->beginPage();
?>
    <!doctype html>
    <!--[if lte IE 9]>
    <html class="lte-ie9" lang="en">
    <![endif]-->
    <!--[if gt IE 9]><!-->
    <html lang="en">
    <!--<![endif]-->
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="initial-scale=1.0,maximum-scale=1.0,user-scalable=no">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="msapplication-tap-highlight" content="no"/>
        <?= Html::csrfMetaTags() ?>
        <title><?= strlen($this->title) ? Html::encode($this->title) . ' - ' : '' ?>LinkIT360</title>
        <?php
        $this->head();
        ?>
    </head>
    <body class=" sidebar_main_open sidebar_main_swipe">
    <?php
    $this->beginBody();
    ?>
    <!-- main header -->
    <header id="header_main">
        <div class="header_main_content">
            <nav class="uk-navbar">

                <!-- main sidebar switch -->
                <a href="#" id="sidebar_main_toggle" class="sSwitch sSwitch_left">
                    <span class="sSwitchIcon"></span>
                </a>

                <div class="uk-navbar-flip">
                    <ul class="uk-navbar-nav user_actions">
                        <li>
                            <a href="#" id="full_screen_toggle" class="user_action_icon uk-visible-large">
                                <i class="material-icons md-24 md-light">&#xE5D0;</i>
                            </a>
                        </li>
                    </ul>
                </div>
            </nav>
        </div>
    </header>
    <!-- main header end -->

    <!-- main sidebar -->
    <?= $this->render('sidebar') ?>
    <!-- main sidebar end -->

    <aside>
        <div id="page_content">
            <div id="page_content_inner">
                <?php
                //                echo Breadcrumbs::widget([
                //                    'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
                //                ]);

                echo $content;
                ?>
            </div>
        </div>
    </aside>
    <?php
    $this->endBody();
    ?>
    </body>
    </html>
<?php
$this->endPage();
