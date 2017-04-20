<?php

namespace backend\controllers;

use Yii;
use backend\models\TrNews;
use backend\models\TrNewsSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * TrNewsController implements the CRUD actions for TrNews model.
 */
class TrNewsController extends Controller {

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
     * Lists all TrNews models.
     * @return mixed
     */
    public function actionIndex() {
        $searchModel = new TrNewsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single TrNews model.
     * @param string $id
     * @return mixed
     */
    public function actionView($id) {
        return $this->render('view', [
                    'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new TrNews model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {
        $model = new TrNews();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                        'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing TrNews model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     */
    public function actionUpdate() {
        if (isset(Yii::$app->request->post()['TrNews'])) {

            $model = new TrNews();

            $arrPost = Yii::$app->request->post()['TrNews'];

            $trModel = $model->findOne(['language_id' => $arrPost['language_id'], 'news_id' => $arrPost['news_id']]);
            if ($trModel) {
                $trModel->name = $arrPost['name'];
                $trModel->short_description = $arrPost['short_description'];
                $trModel->description = $arrPost['description'];
                $trModel->language_id = $arrPost['language_id'];
                $trModel->news_id = $arrPost['news_id'];
            } else {
                $trModel = new TrNews();
                $trModel->name = $arrPost['name'];
                $trModel->short_description = $arrPost['short_description'];
                $trModel->description = $arrPost['description'];
                $trModel->language_id = $arrPost['language_id'];
                $trModel->news_id = $arrPost['news_id'];
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
            $tr_materialObj = new TrNews();
            $tr_materia = $tr_materialObj->findOne(['language_id' => $arrPost['lang'], 'news_id' => $arrPost['news']]);

            if (!$tr_materia) {
                $tr_materia = new TrNews();
                $tr_materia->language_id = $arrPost['lang'];
                $tr_materia->news_id = $arrPost['news'];
            }
            echo $this->renderAjax('_form', [
                'model' => $tr_materia,
            ]);
            exit();
        }
    }

    /**
     * Deletes an existing TrNews model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     */
    public function actionDelete($id) {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the TrNews model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return TrNews the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = TrNews::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

}
