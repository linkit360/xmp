<?php
$menu = [];

$menu[] = [
    'name' => 'Dashboard',
    'url' => '/',
];

$menu[] = [
    'name' => 'Reports',
    'items' => [
        [
            'name' => 'Advertising',
            'url' => 'reports/index',
        ],
        [
            'name' => 'Conversion',
            'url' => 'reports/conversion',
        ],
    ],
];

$menu[] = [
    'name' => 'LP Designer',
    'url' => 'landing-page/designer',
];

$menu[] = [
    'name' => 'Logs',
    'url' => 'logs/index',
];

$menu[] = [
    'name' => 'Admin',
    'items' => [
        [
            'name' => 'Monitoring',
            'url' => 'site/monitoring',
        ],
        [
            'name' => 'Countries',
            'url' => 'countries/index',
        ],
        [
            'name' => 'Providers',
            'url' => 'providers/index',
        ],
        [
            'name' => 'Operators',
            'url' => 'operators/index',
        ],
        [
            'name' => 'Blacklist',
            'url' => 'blacklist/index',
        ],
        [
            'name' => 'Users',
            'url' => 'users/index',
        ],
    ],
];

function drawItem($item)
{
    $url = $item['url'];
    if ($url == '/') {
        $url = '';
    }

    $active = '';
    if ($url === Yii::$app->request->pathInfo) {
        $active = ' class="active"';
    }
    ?>
    <li<?= $active ?>>
        <a href="/<?= $url ?>"><span class="nav-label"><?= $item['name'] ?></span></a>
    </li>
    <?php
}

function drawSub($menu)
{

    $urls = [];
    foreach ($menu['items'] as $item) {
        $urls[] = $item['url'];
    }

    $active = '';
    if (in_array(Yii::$app->request->pathInfo, $urls)) {
        $active = ' class="active"';
    }
    ?>

    <li<?= $active ?>>
        <a href="#"><span class="nav-label"><?= $menu['name'] ?></span><span class="fa arrow"></span></a>
        <ul class="nav nav-second-level">
            <?php
            foreach ($menu['items'] as $item) {
                drawItem($item);
            }
            ?>
        </ul>
    </li>
    <?php
}

?>
<aside id="menu">
    <div id="navigation">
        <ul class="nav" id="side-menu">
            <?php
            foreach ($menu as $item) {
                if (!array_key_exists('url', $item)) {
                    drawSub($item);
                } else {
                    drawItem($item);
                }
            }
            ?>
        </ul>
    </div>
</aside>
