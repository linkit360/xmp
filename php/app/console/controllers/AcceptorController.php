<?php

namespace console\controllers;

use React\EventLoop\Factory;
use React\Socket\ConnectionInterface;
use React\Socket\Server;
use yii\console\Controller;

class AcceptorController extends Controller
{
    public function actionIndex()
    {

///home/caravus/projects/xmp2/go/aggregate-linux-amd64 --config=/home/caravus/projects/xmp2/go/aggregate.yml


        $loop = Factory::create();
        $socket = new Server(50313, $loop);

        $socket->on('connection', function (ConnectionInterface $conn) {


            echo 'Connect' . PHP_EOL;
            $conn->write(json_encode("Hello " . $conn->getRemoteAddress() . "!\n"));

//            $conn->on('data', function ($data, ConnectionInterface $conn) {
//                print_r($data);
//                $conn->write('1');
//            });

        });

        $loop->run();

    }
}
