<?php

namespace frontend\controllers;

use Yii;
use yii\web\Controller;
use frontend\models\LogsForm;

/**
 * LogsController implements the CRUD actions for Transactions model.
 */
class LogsController extends Controller
{
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
