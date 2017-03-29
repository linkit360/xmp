<?php

namespace frontend\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;

use frontend\models\LogsForm;

/**
 * LogsController implements the CRUD actions for Transactions model.
 */
class LogsController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true,
                        'actions' => [
                            'index',
                        ],
                        'roles' => [
                            'logsView',
                        ],
                    ],
                    [
                        'allow' => false,
                    ],
                ],
            ],
        ];
    }

    /**
     * Lists all Transactions models.
     * @return mixed
     */
    public function actionIndex()
    {
        $model = new LogsForm;
        $model->load(Yii::$app->request->get());

        return $this->render('index', [
            'model' => $model,
            'dataProvider' => $model->dataProvider(),
        ]);
    }
}
