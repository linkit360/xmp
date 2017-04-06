<?php

namespace frontend\controllers;

use function array_keys;
use common\models\Countries;
use common\models\Providers;
use common\models\Reports;
use function count;
use function date;
use function dump;
use const false;
use function json_decode;
use function json_encode;
use const JSON_PRETTY_PRINT;
use function mt_rand;
use const PHP_EOL;
use function print_r;
use stdClass;
use function time;
use const true;
use Yii;
use yii\db\Query;
use yii\web\Controller;
use yii\filters\AccessControl;

use common\models\LoginForm;

/**
 * Site Controller
 */
class SiteController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => [
                            'error',
                            'login',
                            'rpc',
                        ],
                        'allow' => true,
                    ],
                    [
                        'actions' => [
                            'index',
                            'monitoring',
                            'logout',
                            'country',
                        ],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                    [
                        'allow' => false,
                    ],
                ],
            ],
        ];
    }

    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    public function beforeAction($action)
    {
        if ($action->id === 'error' && Yii::$app->user->isGuest) {
            $this->layout = 'empty';
        }

        if ($action->id === 'login') {
//            $this->enableCsrfValidation = false;
        }

        return parent::beforeAction($action);
    }

    /**
     * Displays homepage.
     *
     * @return mixed
     */
    public function actionIndex()
    {
        return $this->render('index');
    }

    /**
     * Displays monitoring page.
     *
     * @return mixed
     */
    public function actionMonitoring()
    {
        return $this->render('monitoring');
    }

    /**
     * Logs in a user.
     *
     * @return mixed
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $this->layout = 'empty';
        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }

        return $this->render('login', [
            'model' => $model,
        ]);
    }

    /**
     * Logs out the current user.
     *
     * @return mixed
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();
        return $this->goHome();
    }

    public function actionRpc()
    {
        return;

        $str = '{"aggregated":[{"report_at":1490958234,"id_campaign":5,"provider_name":"cheese","operator_code":52000,"lp_hits":151,"lp_msisdn_hits":21,"mo":51,"mo_uniq":137,"mo_success":20,"retry_success":108,"pixels":148}]}';
        $str = json_decode($str);
        $str = json_encode($str, JSON_PRETTY_PRINT);
        echo '<h2>Array</h2><pre>';
        print_r($str);
        return;
        /*
                             [

                                 'report_at' => time(),
                                 'id_campaign' => mt_rand(1, 10),
                                 'provider_name' => 'cheese',
                                 'operator_code' => 52000,
                                 'lp_hits' => mt_rand(10, 200),
                                 'lp_msisdn_hits' => mt_rand(10, 100),
                                 'mo' => mt_rand(10, 200),
                                 'mo_uniq' => mt_rand(10, 200),
                                 'mo_success' => mt_rand(10, 200),
                                 'retry_success' => mt_rand(10, 200),
                                 'pixels' => mt_rand(10, 200),
                             ],
                             */
        $obj = new stdClass();

        $obj->report_at = time();
        $obj->id_campaign = mt_rand(1, 10);
        $obj->provider_name = 'cheese';
        $obj->operator_code = 52000;
        $obj->lp_hits = mt_rand(10, 200);
        $obj->lp_msisdn_hits = mt_rand(10, 100);
        $obj->mo = mt_rand(10, 200);
        $obj->mo_uniq = mt_rand(10, 200);
        $obj->mo_success = mt_rand(10, 200);
        $obj->retry_success = mt_rand(10, 200);
        $obj->pixels = mt_rand(10, 200);


        $obj2 = new stdClass();
        $obj2->aggregated = [
            $obj,
        ];

//        print_r($obj2);


        $data = [
            'jsonrpc' => 2.0,
            'method' => 'Aggregate.Receive',
            'id' => mt_rand(1000000000, 9999999999),
            'params' => $obj2,
        ];

        echo '<h2>Array</h2><pre>';
        print_r($data);
        echo PHP_EOL . PHP_EOL . PHP_EOL;


//        $in = json_encode($data, JSON_PRETTY_PRINT);

//        $data['params'] = $s
//        $in = $str;


        $in = '{
    "jsonrpc": 2,
    "method": "Aggregate.Receive",
    "id": 5009172138,
    "params": ' . $str . '
}';

        echo '</pre><h2>JSON</h2><pre>';
        print_r($in);

        return;


        $service_port = 10000;
        $address = gethostbyname('go');

        $socket = socket_create(AF_INET, SOCK_STREAM, SOL_TCP);
        if ($socket === false) {
            echo "Не удалось выполнить socket_create(): причина: " . socket_strerror(socket_last_error()) . "\n";
        } else {
//            echo "OK.\n";
        }

//        echo "Пытаемся соединиться с '$address' на порту '$service_port'...";
        $result = socket_connect($socket, $address, $service_port);
        if ($result === false) {
            echo "Не удалось выполнить socket_connect().\nПричина: ($result) " . socket_strerror(socket_last_error($socket)) . "\n";
        } else {
//            echo "OK.\n";
        }

//        echo "Отправляем запрос...";


        socket_write($socket, $in, strlen($in));
//        echo "OK.\n";
//        echo "Закрываем сокет...";
        socket_close($socket);
//        echo "OK.\n\n";
    }

    public function actionCountry()
    {
        $this->layout = 'empty';

        $country = Countries::find()
            ->select([
                'id',
                'name',
            ])
            ->where([
                'iso' => $_GET['iso'],
            ])
            ->asArray()
            ->one();

        $providers = Providers::find()
            ->select('name_alias')
            ->where([
                'id_country' => $country['id'],
            ])
            ->indexBy('name_alias')
            ->asArray()
            ->all();

        $query = (new Query())
            ->from('xmp_reports')
            ->select([
                'SUM(lp_hits) as lp_hits',
                'SUM(mo) as mo',
                'SUM(mo_success) as mo_success',

                "date_trunc('day', report_at) as report_at_day",
            ])
            ->where([
                'AND',
                "report_at >= '" . date('Y-m-d') . "'",
                [
                    'provider_name' => array_keys($providers),
                ],
            ])
            ->groupBy([
                'report_at_day',
            ])->all();

        if (count($query)) {

            $data = $query[0];
            $data['name'] = $country['name'];

            echo json_encode($data, JSON_PRETTY_PRINT);
        }
    }
}
