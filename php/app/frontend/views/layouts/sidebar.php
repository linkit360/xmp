<?php
$u = \Yii::$app->user;
$menu = [];

$menu[] = [
    'name' => 'Dashboard',
    'url' => '/',
];

# Reports
$menu['Reports'] = [
    'name' => 'Reports',
    'items' => [],
];

if ($u->can('reportsAdvertisingView')) {
    $menu['Reports']['items'][] = [
        'name' => 'Advertising',
        'url' => 'reports/index',
    ];
}

if ($u->can('reportsConversionView')) {
    $menu['Reports']['items'][] = [
        'name' => 'Conversion',
        'url' => 'reports/conversion',
    ];
}

if (!count($menu['Reports']['items'])) {
    unset($menu['Reports']);
}

$menu[] = [
    'name' => 'LP Designer',
    'url' => 'landing-page/designer',
];

if ($u->can('logsView')) {
    $menu[] = [
        'name' => 'Logs',
        'url' => 'logs/index',
    ];
}

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
        [
            'name' => 'RBAC',
            'url' => 'rbac/index',
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

        // crud
        if (substr_count($item['url'], '/index')) {
            $urls[] = str_replace('/index', '/view', $item['url']);
            $urls[] = str_replace('/index', '/create', $item['url']);
            $urls[] = str_replace('/index', '/update', $item['url']);
        }
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
