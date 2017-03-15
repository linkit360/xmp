<?php
/**
 * @var \yii\web\View $this
 * @var string        $content
 */

use yii\helpers\Html;
use app\assets\AltairAsset;

AltairAsset::register($this);
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
        <!-- Remove Tap Highlight on Windows Phone IE -->
        <meta name="msapplication-tap-highlight" content="no"/>

        <?= Html::csrfMetaTags() ?>
        <title><?= Html::encode($this->title) ?></title>
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

                <!-- secondary sidebar switch -->
                <!--
                                <a href="#" id="sidebar_secondary_toggle" class="sSwitch sSwitch_right sidebar_secondary_check">
                                    <span class="sSwitchIcon"></span>
                                </a>
                -->
                <!-- TOP MENU
                                    <div id="menu_top_dropdown" class="uk-float-left uk-hidden-small">
                                        <div class="uk-button-dropdown" data-uk-dropdown="{mode:'click'}">
                                            <a href="#" class="top_menu_toggle"><i class="material-icons md-24">&#xE8F0;</i></a>
                                            <div class="uk-dropdown uk-dropdown-width-3">
                                                <div class="uk-grid uk-dropdown-grid" data-uk-grid-margin>
                                                    <div class="uk-width-2-3">
                                                        <div class="uk-grid uk-grid-width-medium-1-3 uk-margin-top uk-margin-bottom uk-text-center" data-uk-grid-margin>
                                                            <a href="page_mailbox.html">
                                                                <i class="material-icons md-36">&#xE158;</i>
                                                                <span class="uk-text-muted uk-display-block">Mailbox</span>
                                                            </a>
                                                            <a href="page_invoices.html">
                                                                <i class="material-icons md-36">&#xE53E;</i>
                                                                <span class="uk-text-muted uk-display-block">Invoices</span>
                                                            </a>
                                                            <a href="page_chat.html">
                                                                <i class="material-icons md-36 md-color-red-600">&#xE0B9;</i>
                                                                <span class="uk-text-muted uk-display-block">Chat</span>
                                                            </a>
                                                            <a href="page_scrum_board.html">
                                                                <i class="material-icons md-36">&#xE85C;</i>
                                                                <span class="uk-text-muted uk-display-block">Scrum Board</span>
                                                            </a>
                                                            <a href="page_snippets.html">
                                                                <i class="material-icons md-36">&#xE86F;</i>
                                                                <span class="uk-text-muted uk-display-block">Snippets</span>
                                                            </a>
                                                            <a href="page_user_profile.html">
                                                                <i class="material-icons md-36">&#xE87C;</i>
                                                                <span class="uk-text-muted uk-display-block">User profile</span>
                                                            </a>
                                                        </div>
                                                    </div>
                                                    <div class="uk-width-1-3">
                                                        <ul class="uk-nav uk-nav-dropdown uk-panel">
                                                            <li class="uk-nav-header">Components</li>
                                                            <li><a href="components_accordion.html">Accordions</a></li>
                                                            <li><a href="components_buttons.html">Buttons</a></li>
                                                            <li><a href="components_notifications.html">Notifications</a></li>
                                                            <li><a href="components_sortable.html">Sortable</a></li>
                                                            <li><a href="components_tabs.html">Tabs</a></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                -->
                <div class="uk-navbar-flip">
                    <ul class="uk-navbar-nav user_actions">
                        <li>
                            <a href="#" id="full_screen_toggle" class="user_action_icon uk-visible-large">
                                <i class="material-icons md-24 md-light">&#xE5D0;</i>
                            </a>
                        </li>

                        <!--
                        <li data-uk-dropdown="{mode:'click',pos:'bottom-right'}">
                            <a href="#" class="user_action_image">
                                <img class="md-user-image" src="altair/assets/img/user.png" alt=""/>
                            </a>

                            <div class="uk-dropdown uk-dropdown-small">
                                <ul class="uk-nav js-uk-prevent">
                                    <li><a href="/">My profile</a></li>
                                    <li><a href="/">Settings</a></li>
                                    <li><a href="/">Logout</a></li>
                                </ul>
                            </div>
                        </li>
                        -->
                    </ul>
                </div>
            </nav>
        </div>
        <div class="header_main_search_form">
            <i class="md-icon header_main_search_close material-icons">&#xE5CD;</i>
            <form class="uk-form">
                <input type="text" class="header_main_search_input"/>
                <button class="header_main_search_btn uk-button-link"><i class="md-icon material-icons">&#xE8B6;</i>
                </button>
            </form>
        </div>
    </header><!-- main header end -->

    <!-- main sidebar -->
    <?= $this->render('sidebar') ?>
    <!-- main sidebar end -->

    <aside>
        <div id="page_content">
            <div id="page_content_inner">
                <?= $content ?>
            </div>
        </div>
    </aside><!-- secondary sidebar end -->
    <?php
    $this->endBody();
    ?>
    </body>
    </html>
<?php
$this->endPage();
