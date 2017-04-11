<?php
use yii\helpers\Html;
use yii\helpers\Url;

$permissions = Yii::$app->getAuthManager()->getPermissionsByUser(Yii::$app->user->id);
$permissions = array_keys($permissions);

$menu = [];
$menu[] = [
    'name' => '<i class="fa fa-th-large"></i> Dashboard',
    'url' => '/',
];

# Reports
$group = 'Reports';
$menu[$group] = [
    'name' => '<i class="fa fa-bar-chart-o"></i> Reports',
    'items' => [],
];

if (in_array('reportsAdvertisingView', $permissions)) {
    $menu[$group]['items'][] = [
        'name' => 'Advertising',
        'url' => 'reports/index',
    ];
}

if (in_array('reportsConversionView', $permissions)) {
    $menu[$group]['items'][] = [
        'name' => 'Conversion',
        'url' => 'reports/conversion',
    ];
}

# Campaigns
$group = 'Campaigns';
$menu[$group] = [
    'name' => '<i class="fa fa-list"></i> Campaigns',
    'items' => [],
];

if (in_array('campaignsManage', $permissions)) {
    $menu[$group]['items'][] = [
        'name' => 'Campaigns Management',
        'url' => 'campaigns/index',
    ];
}

if (in_array('lpCreate', $permissions)) {
    $menu[$group]['items'][] = [
        'name' => 'LP Management',
        'url' => 'landing-page/index',
    ];
}

# Admin
$group = 'Admin';
$menu[$group] = [
    'name' => '<i class="fa fa-keyboard-o"></i> Admin',
    'items' => [],
];

if (in_array('monitoringView', $permissions)) {
    $menu[$group]['items'][] = [
        'name' => 'Monitoring',
        'url' => 'site/monitoring',
    ];
}

if (in_array('countriesManage', $permissions)) {
    $menu[$group]['items'][] = [
        'name' => 'Countries',
        'url' => 'countries/index',
    ];
}

if (in_array('providersManage', $permissions)) {
    $menu[$group]['items'][] = [
        'name' => 'Providers',
        'url' => 'providers/index',
    ];
}

if (in_array('operatorsManage', $permissions)) {
    $menu[$group]['items'][] = [
        'name' => 'Operators',
        'url' => 'operators/index',
    ];
}

if (in_array('blacklistManage', $permissions)) {
    $menu[$group]['items'][] = [
        'name' => 'Blacklist',
        'url' => 'blacklist/index',
    ];
}

if (in_array('usersManage', $permissions)) {
    $menu[$group]['items'][] = [
        'name' => 'Users',
        'url' => 'users/index',
    ];
}

if (in_array('rbacManage', $permissions)) {
    $menu[$group]['items'][] = [
        'name' => 'RBAC',
        'url' => 'rbac/index',
    ];
}

if (in_array('logsView', $permissions)) {
    $menu[$group]['items'][] = [
        'name' => 'Logs',
        'url' => 'logs/index',
    ];
}

function drawItem($item, $path)
{
    $url = $item['url'];
    if ($url == '/') {
        $url = '';
    }


    echo Html::tag(
        'li',
        Html::a(
            $item['name'],
            Url::toRoute($url)
        ),
        [
            'class' => str_replace('/index', '', $url) !== $path ?: 'active',
        ]
    );
}

function drawSub($menu, $path)
{
    $urls = [];
    foreach ($menu['items'] as $item) {
        $urls[] = $item['url'];

        // crud
        if (substr_count($item['url'], '/index')) {
            $urls[] = str_replace('/index', '', $item['url']);
        }
    }
    ?>
    <li class="<?= !in_array($path, $urls) ?: 'active' ?>">
        <a href="#"><span class="nav-label"><?= $menu['name'] ?></span> <span class="fa arrow"></span></a>
        <ul class="nav nav-second-level collapse">
            <?php
            foreach ($menu['items'] as $item) {
                drawItem($item, $path);
            }
            ?>
        </ul>
    </li>
    <?php
}

?>
<nav class="navbar-default navbar-static-side" role="navigation">
    <div class="sidebar-collapse">
        <ul class="nav metismenu" id="side-menu">
            <li class="nav-header" style="background: none;">
                <div class="profile-element text-center">
                    <img src="/img/linkitlogo.png"/>
                </div>

                <div class="logo-element">
                    XMP
                </div>
            </li>

            <?php
            $ex = explode('/', Yii::$app->request->pathInfo, 2);
            foreach ($menu as $item) {
                if (!array_key_exists('url', $item)) {
                    if (count($item['items'])) {
                        drawSub($item, $ex[0]);
                    }
                } else {
                    drawItem($item, $ex[0]);
                }
            }
            ?>
        </ul>
    </div>
</nav>
