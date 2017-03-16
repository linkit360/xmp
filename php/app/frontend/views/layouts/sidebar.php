<?php
use yii\helpers\Url;

?>
<aside id="menu">
    <div id="navigation">
        <!--
        <div class="profile-picture">
            <div class="stats-label text-color">
                <span class="font-extra-bold font-uppercase">Username</span>

                <div class="dropdown">
                    <a class="dropdown-toggle" href="#" data-toggle="dropdown">
                        <small class="text-muted">Links <b class="caret"></b></small>
                    </a>
                    <ul class="dropdown-menu animated flipInX m-t-xs">
                        <li><a href="#">Example link</a></li>
                        <li><a href="#">Example link</a></li>
                    </ul>
                </div>
            </div>
        </div>
        -->

        <ul class="nav" id="side-menu">
            <li>
                <a href="<?= Url::to('/reports/index') ?>">
                    <span class="nav-label">Advertising</span>
                </a>
            </li>

            <li>
                <a href="<?= Url::to('/landing-page/designer') ?>">
                    <span class="nav-label">LP Designer</span>
                </a>
            </li>

            <li>
                <a href="<?= Url::to('/countries/index') ?>">
                    <span class="nav-label">Countries</span>
                </a>
            </li>
        </ul>
    </div>
</aside>
