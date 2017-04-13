<?php

namespace frontend\controllers;

use function json_encode;
use const JSON_PRETTY_PRINT;
use const null;
use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

use common\models\Services;
use frontend\models\Services\CheeseForm;

/**
 * ServicesController implements the CRUD actions for Services model.
 */
class ServicesController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Services models.
     * @return mixed
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Services::find(),
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Services model.
     *
     * @param string $id
     *
     * @return mixed
     */
    public function actionView($id)
    {
        $model = $this->findModel($id);
        $modelProvider = $this->getProviderModel($model->id_provider);
        $modelProvider->load(json_decode($model->service_opts, true), '');

        return $this->render(
            'view',
            [
                'model' => $model,
                'modelProvider' => $modelProvider,
            ]
        );
    }

    /**
     * Creates a new Services model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $get = Yii::$app->request->get();
        $model = new Services();
        $model->loadDefaultValues();
        $stepNow = 1;
        if (array_key_exists('step', $get)) {
            $stepNow = (integer)$get['step'];
        }

        # Step 2, Provider
        if ($stepNow === 2) {
            if (!array_key_exists('id_country', $get)) {
                return $this->redirect('/services/create?step=1');
            }
        }

        $modelProvider = null;
        # Step 3, Service
        if ($stepNow === 3) {
            $modelProvider = $this->getProviderModel((integer)$get['id_provider']);

            if ($modelProvider === null) {
                return $this->redirect('/services/create?step=1');
            }

            if (
                $model->load(Yii::$app->request->post()) &&
                $modelProvider->load(Yii::$app->request->post())
            ) {
                # Provider
                if ($modelProvider->validate()) {
                    $model->service_opts = json_encode(
                        $modelProvider->attributes,
                        JSON_PRETTY_PRINT
                    );

                    # Service
                    if ($model->validate()) {
                        $model->save();
                        return $this->redirect(['view', 'id' => $model->id]);
                    }
                }
            }
        }

        return $this->render(
            'create',
            [
                'stepNow' => $stepNow,
                'models' => [
                    'model_service' => $model,
                    'model_provider' => $modelProvider,
                ],
            ]
        );
    }

    /**
     * @param int $id_provider
     *
     * @return Model|null
     */
    public function getProviderModel($id_provider)
    {
        switch ($id_provider) {

            // TH - Cheese Mobile
            case 1:
                return new CheeseForm();
                break;

            default:
                return null;
                break;
        }
    }


    /**
     * Updates an existing Services model.
     * If update is successful, the browser will be redirected to the 'view' page.
     *
     * @param string $id
     *
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Services model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     *
     * @param string $id
     *
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Services model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     *
     * @param string $id
     *
     * @return Services the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Services::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
