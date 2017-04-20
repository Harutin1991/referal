<?php

namespace backend\controllers;

use Yii;
use backend\models\TrService;
use backend\models\TrServiceSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * TrServiceController implements the CRUD actions for TrService model.
 */
class TrServiceController extends Controller
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
     * Lists all TrService models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new TrServiceSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single TrService model.
     * @param string $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new TrService model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new TrService();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing TrService model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     */
     public function actionUpdate() {
        if (isset(Yii::$app->request->post()['TrService'])) {
            $model = new TrService();
            $arrPost = Yii::$app->request->post()['TrService'];
            $trModel = $model->findOne(['language_id' => $arrPost['language_id'], 'service_id' => $arrPost['service_id']]);
            if ($trModel) {
                $trModel->name = $arrPost['name'];
                $trModel->short_description = $arrPost['short_description'];
                $trModel->language_id = $arrPost['language_id'];
                $trModel->service_id = $arrPost['service_id'];
            } else {
                $trModel = new TrService();
                $trModel->name = $arrPost['name'];
                $trModel->short_description = $arrPost['short_description'];
                $trModel->language_id = $arrPost['language_id'];
                $trModel->service_id = $arrPost['service_id'];
            }

            if ($trModel->save()) {
                echo 'true';
                exit();
            } else {
                echo 'false';
                exit();
            }
        } elseif (Yii::$app->request->isAjax) {

            $arrPost = Yii::$app->request->post();
            $tr_materialObj = new TrService();
            $tr_materia = $tr_materialObj->findOne(['language_id' => $arrPost['lang'], 'service_id' => $arrPost['service']]);

            if (!$tr_materia) {
                $tr_materia = new TrService();
                $tr_materia->language_id = $arrPost['lang'];
                $tr_materia->service_id = $arrPost['service'];
            }
            echo $this->renderAjax('_form', [
                'model' => $tr_materia,
            ]);
            exit();
        }
    }

    /**
     * Deletes an existing TrService model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the TrService model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return TrService the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = TrService::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
