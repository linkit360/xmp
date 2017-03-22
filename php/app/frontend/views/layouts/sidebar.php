<?php
use yii\helpers\Url;

$url = Yii::$app->request->url;
?>
<aside id="menu">
    <div id="navigation">
        <ul class="nav" id="side-menu">
            <li class="<?= $url !== '/' ?: 'active' ?>">
                <a href="/"><span class="nav-label">Dashboard</span></a>
            </li>

            <li class="<?= substr($url, 0, 16) !== '/site/monitoring' ?: 'active' ?>">
                <a href="<?= Url::to('/site/monitoring') ?>"><span class="nav-label">Monitoring</span></a>
            </li>

            <li class="<?= substr($url, 0, 8) !== '/reports' ?: 'active' ?>">
                <a href="#"><span class="nav-label">Reports</span><span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li class="<?= substr($url, 0, 14) !== '/reports/index' ?: 'active' ?>">
                        <a href="<?= Url::to('/reports/index') ?>">
                            <span class="nav-label">Advertising</span>
                        </a>
                    </li>

                    <li class="<?= substr($url, 0, 19) !== '/reports/conversion' ?: 'active' ?>">
                        <a href="<?= Url::to('/reports/conversion') ?>">
                            <span class="nav-label">Conversion</span>
                        </a>
                    </li>

                </ul>
            </li>

            <li>
                <a href="<?= Url::to('/landing-page/designer') ?>">
                    <span class="nav-label">LP Designer</span>
                </a>
            </li>

            <li>
                <a href="<?= Url::to('/countries') ?>">
                    <span class="nav-label">Countries</span>
                </a>
            </li>

            <li>
                <a href="<?= Url::to('/providers') ?>">
                    <span class="nav-label">Providers</span>
                </a>
            </li>

            <li>
                <a href="<?= Url::to('/operators') ?>">
                    <span class="nav-label">Operators</span>
                </a>
            </li>

            <li>
                <a href="<?= Url::to('/blacklist') ?>">
                    <span class="nav-label">Blacklist</span>
                </a>
            </li>

            <li>
                <a href="<?= Url::to('/logs') ?>">
                    <span class="nav-label">Logs</span>
                </a>
            </li>
        </ul>
    </div>
</aside>
