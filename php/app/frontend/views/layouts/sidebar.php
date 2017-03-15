<?php
use yii\helpers\Url;

function showMenu($url, $text)
{
    ?>
    <li>
        <a href="<?= $url ?>"><?= $text ?></a>
    </li>
    <?php
}

?>
<aside id="sidebar_main">
    <div style="text-align: center">
        <a href="/"><img src="/altair/assets/img/LinkIT360_logo.png"/></a>
    </div>

    <div class="menu_section">
        <ul>
            <li class="current_section" title="Dashboard">
                <a href="<?= Url::to('/site/index') ?>">
                    <span class="menu_icon"><i class="material-icons">&#xE871;</i></span>
                    <span class="menu_title">DASHBOARD</span>
                </a>
            </li>

            <li title="Reports">
                <a>
                    <span class="menu_icon"><i class="material-icons">&#xE85C;</i></span>
                    <span class="menu_title">REPORTS</span>
                </a>
                <ul>
                    <!--<li><a href="/reports">Revenue</a></li>-->
                    <!--<li><a href="/conversion-report">Conversion</a></li>-->
                    <li><a href="<?= Url::to('/reports/index') ?>">Advertising</a></li>
                </ul>
            </li>

            <li title="Tools">
                <a href="#">
                    <span class="menu_icon"><i class="material-icons">&#xE8B8;</i></span>
                    <span class="menu_title">TOOLS</span>
                </a>
                <ul>
                    <?php
                    showMenu('/landing-page/designer', 'Landing Page Designer');
                    ?>
                </ul>
            </li>
        </ul>
    </div>
</aside>
