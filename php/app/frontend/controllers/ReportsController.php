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
     * Reports Search Form
     * @return mixed
     */
    public function actionIndex()
    {
        $model = new ReportsForm();
//        dump($model->attributes);
//        dump(Yii::$app->request->get());

        $model->load(Yii::$app->request->get());

//        dump($model->attributes);

        return $this->render('index', [
            'model' => $model,
        ]);
    }
}
