<?php

namespace backend\controllers;

use Yii;
use backend\models\TrWorks;
use backend\models\TrWorksSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * TrWorksController implements the CRUD actions for TrWorks model.
 */
class TrWorksController extends Controller {

    /**
     * @inheritdoc
     */
    public function behaviors() {
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
     * Lists all TrWorks models.
     * @return mixed
     */
    public function actionIndex() {
        $searchModel = new TrWorksSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single TrWorks model.
     * @param string $id
     * @return mixed
     */
    public function actionView($id) {
        return $this->render('view', [
                    'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new TrWorks model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {
        $model = new TrWorks();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                        'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing TrWorks model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     */
    public function actionUpdate() {
        if (isset(Yii::$app->request->post()['TrWorks'])) {

            $model = new TrWorks();

            $arrPost = Yii::$app->request->post()['TrWorks'];
            
            $trModel = $model->findOne(['language_id' => $arrPost['language_id'], 'works_id' => $arrPost['works_id']]);
            if ($trModel) {
                $trModel->name = $arrPost['name'];
                $trModel->short_description = $arrPost['short_description'];
                $trModel->description = $arrPost['description'];
                $trModel->language_id = $arrPost['language_id'];
                $trModel->works_id = $arrPost['works_id'];
            } else {
                $trModel = new TrWorks();
                $trModel->name = $arrPost['name'];
                $trModel->short_description = $arrPost['short_description'];
                $trModel->description = $arrPost['description'];
                $trModel->language_id = $arrPost['language_id'];
                $trModel->works_id = $arrPost['works_id'];
            }

            if ($trModel->save()) {
                echo 'true';
                exit();
            } else {
                echo 'false';
                exit();
            }
        } elseif (!empty(Yii::$app->request->post()) && Yii::$app->request->isAjax) {

            $arrPost = Yii::$app->request->post();
            $tr_workObj = new TrWorks();
            $tr_work = $tr_workObj->findOne(['language_id' => $arrPost['lang'], 'works_id' => $arrPost['work']]);

            if (!$tr_work) {
                $tr_work = new TrWorks();
                $tr_work->language_id = $arrPost['lang'];
                $tr_work->works_id = $arrPost['work'];
            }
            echo $this->renderAjax('_form', [
                'model' => $tr_work,
            ]);
            exit();
        }
    }

    /**
     * Deletes an existing TrWorks model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     */
    public function actionDelete($id) {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the TrWorks model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return TrWorks the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = TrWorks::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

}
