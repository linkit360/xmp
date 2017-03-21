<?php

namespace frontend\controllers;

use Yii;
use yii\web\Controller;
use frontend\models\ReportsForm;

/**
 * ReportsController implements the CRUD actions for Reports model.
 */
class ReportsController extends Controller
{
    /**
     * AD REPORT
     *
     * @return mixed
     */
    public function actionIndex()
    {
        $model = new ReportsForm();
        $model->load(Yii::$app->request->get());
        return $this->render('index', [
            'model' => $model,
        ]);
    }

    /**
     * Conversion report
     *
     * @return mixed
     */
    public function actionConversion()
    {
        $model = new ReportsForm();
        $model->load(Yii::$app->request->get());
        return $this->render('conversion', [
            'model' => $model,
        ]);
    }
}
