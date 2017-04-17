<?php
use yii\grid\GridView;

/**
 * @var yii\web\View                $this
 * @var yii\data\ActiveDataProvider $dataProvider
 */
?>
<div class="col-lg-12">
    <div class="ibox">
        <div class="ibox-content">
            <?php
            echo GridView::widget(
                [
                    'dataProvider' => $dataProvider,
                    'columns' => [
                        [
                            'attribute' => 'time',
                            'contentOptions' => function () {
                                return [
                                    'style' => 'width: 190px;',
                                ];
                            },
                        ],
                        [
                            'label' => 'User',
                            'contentOptions' => function () {
                                return [
                                    'style' => 'width: 1%;',
                                ];
                            },
                            'content' => function ($data) {
                                return \yii\helpers\Html::a($data['user']['username'], '/users/' . $data['user']['id']);
                            },
                        ],
                        [
                            'attribute' => 'controller',
                            'contentOptions' => function () {
                                return [
                                    'style' => 'width: 1%;',
                                ];
                            },
                        ],
                        [
                            'attribute' => 'action',
                            'contentOptions' => function () {
                                return [
                                    'style' => 'width: 1%;',
                                ];
                            },
                        ],
                        [
                            'attribute' => 'event',
                            'content' => function ($data) {
                                $event = json_decode($data['event'], true);
                                if ($event === null) {
                                    return '';
                                }

                                $table = '';
                                if (array_key_exists('id', $event)) {
                                    $table .= 'ID: ' . $event['id'] . '<br/>';
                                }

                                if (array_key_exists('ips', $event)) {
                                    $table .= 'IPs: ';
                                    foreach ($event['ips'] as $ip) {
                                        $table .= $ip . ' ';
                                    }
                                    $table .= '<br/>';
                                }

                                if (array_key_exists('fields', $event)) {
                                    $table .= '<table class="table table-condensed" style="width: 1%;">';

                                    foreach ($event['fields'] as $attr => $field) {
                                        $table .= '<tr>';
                                        $table .= '<td>' . $attr . '</td>';

                                        if (!is_array($field['to'])) {
                                            if ($attr === 'service_opts') {
                                                // json
                                                $table .= '<td class="text-right" style="white-space: nowrap;">';
                                                $json = json_decode($field['from'], true);
                                                if (count($json)) {
                                                    foreach ($json as $k => $v) {
                                                        $table .= $k . '=' . $v . '<br/>';
                                                    }
                                                }
                                                $table .= '</td>';
                                                $table .= '<td style="width: 1%;">=></td>';
                                                $table .= '<td style="white-space: nowrap;">';

                                                $json = json_decode($field['to'], true);
                                                if (count($json)) {
                                                    foreach ($json as $k => $v) {
                                                        $table .= $k . '=' . $v . '<br/>';
                                                    }
                                                }
                                                $table .= '</td>';
                                            } else {
                                                // text
                                                $table .= '<td class="text-right" style="white-space: nowrap;">' .
                                                    $field['from'] .
                                                    '</td>';
                                                $table .= '<td style="width: 1%;">=></td>';
                                                $table .= '<td style="white-space: nowrap;">' .
                                                    $field['to'] .
                                                    '</td>';
                                            }
                                        }
                                        $table .= '</tr>';
                                    }
                                    $table .= '</table>';
                                }

                                if (array_key_exists('roles', $event)) {
                                    $table .= 'Roles:<table class="table table-condensed" style="width: 1%;">';
                                    foreach ($event['roles'] as $role) {
                                        $table .= '<tr>';
                                        $table .= '<td>' . $role . '</td>';
                                        $table .= '</tr>';
                                    }
                                    $table .= '</table>';
                                }

                                return $table;
                            },
                        ],
                    ],
                ]
            );
            ?>
        </div>
    </div>
</div>

