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
                        'time',
                        'id_user',
                        'controller',
                        'action',
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
                                        $table .= '<td class="text-right">' . $field['from'] . '</td>';
                                        $table .= '<td>=></td>';
                                        $table .= '<td>' . $field['to'] . '</td>';
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

