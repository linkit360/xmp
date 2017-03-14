<?php

namespace console\controllers;

use yii\console\Controller;

class AcceptorController extends Controller
{
    public function actionIndex()
    {

        die();

        $socket = stream_socket_server("tcp://0.0.0.0:50313", $errno, $errstr);
        if (!$socket) {
            echo "$errstr ($errno)<br />\n";
        } else {
            while (true) {
                $conn = stream_socket_accept($socket);
                $sock_data = fread($conn, 4096);
                $data = json_decode($sock_data, true);

                switch ($data['method']) {
                    case 'Aggregate.Receive':
                        $this->receive($data);
                        break;
                }

                fwrite($conn, '{}');
                fclose($conn);
            }
            fclose($socket);
        }
    }

    private function receive($data)
    {

        dump($data);
    }
}
