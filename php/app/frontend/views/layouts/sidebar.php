<?php
$permissions = Yii::$app->getAuthManager()->getPermissionsByUser(Yii::$app->user->id);
$permissions = array_keys($permissions);

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

if (in_array('reportsAdvertisingView', $permissions)) {
    $menu['Reports']['items'][] = [
        'name' => 'Advertising',
        'url' => 'reports/index',
    ];
}

if (in_array('reportsConversionView', $permissions)) {
    $menu['Reports']['items'][] = [
        'name' => 'Conversion',
        'url' => 'reports/conversion',
    ];
}

if (!count($menu['Reports']['items'])) {
    unset($menu['Reports']);
}

# Landing Pages
if (in_array('lpCreate', $permissions)) {
    $menu[] = [
        'name' => 'LP Designer',
        'url' => 'landing-page/designer',
    ];
}

# Logs
if (in_array('logsView', $permissions)) {
    $menu[] = [
        'name' => 'Logs',
        'url' => 'logs/index',
    ];
}

# Admin
$menu['Admin'] = [
    'name' => 'Admin',
    'items' => [],
];

if (in_array('monitoringView', $permissions)) {
    $menu['Admin']['items'][] = [
        'name' => 'Monitoring',
        'url' => 'site/monitoring',
    ];
}

if (in_array('countriesManage', $permissions)) {
    $menu['Admin']['items'][] = [
        'name' => 'Countries',
        'url' => 'countries/index',
    ];
}

if (in_array('providersManage', $permissions)) {
    $menu['Admin']['items'][] = [
        'name' => 'Providers',
        'url' => 'providers/index',
    ];
}

if (in_array('operatorsManage', $permissions)) {
    $menu['Admin']['items'][] = [
        'name' => 'Operators',
        'url' => 'operators/index',
    ];
}

//if ($u->can('Admin')) {
//    $menu['Admin']['items'][] = [
//        'name' => 'Blacklist',
//        'url' => 'blacklist/index',
//    ];
//}

if (in_array('usersManage', $permissions)) {
    $menu['Admin']['items'][] = [
        'name' => 'Users',
        'url' => 'users/index',
    ];
}

if (in_array('rbacManage', $permissions)) {
    $menu['Admin']['items'][] = [
        'name' => 'RBAC',
        'url' => 'rbac/index',
    ];
}

if (!count($menu['Admin']['items'])) {
    unset($menu['Admin']);
}

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
