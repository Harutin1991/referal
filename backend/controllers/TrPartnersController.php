<?php

namespace backend\controllers;

use Yii;
use backend\models\TrPartners;
use backend\models\TrPartnersSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * TrPartnersController implements the CRUD actions for TrPartners model.
 */
class TrPartnersController extends Controller {

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
     * Lists all TrPartners models.
     * @return mixed
     */
    public function actionIndex() {
        $searchModel = new TrPartnersSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single TrPartners model.
     * @param string $id
     * @return mixed
     */
    public function actionView($id) {
        return $this->render('view', [
                    'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new TrPartners model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {
        $model = new TrPartners();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                        'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing TrPartners model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     */
    public function actionUpdate() {
        if (isset(Yii::$app->request->post()['TrPartners'])) {

            $model = new TrPartners();

            $arrPost = Yii::$app->request->post()['TrPartners'];

            $trModel = $model->findOne(['language_id' => $arrPost['language_id'], 'partners_id' => $arrPost['partners_id']]);
            if ($trModel) {
                $trModel->title = $arrPost['title'];
                $trModel->short_description = $arrPost['short_description'];
                $trModel->language_id = $arrPost['language_id'];
                $trModel->partners_id = $arrPost['partners_id'];
            } else {
                $trModel = new TrPartners();
                $trModel->title = $arrPost['title'];
                $trModel->short_description = $arrPost['short_description'];
                $trModel->language_id = $arrPost['language_id'];
                $trModel->partners_id = $arrPost['partners_id'];
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
            $tr_materialObj = new TrPartners();
            $tr_materia = $tr_materialObj->findOne(['language_id' => $arrPost['lang'], 'partners_id' => $arrPost['partner']]);

            if (!$tr_materia) {
                $tr_materia = new TrPartners();
                $tr_materia->language_id = $arrPost['lang'];
                $tr_materia->partners_id = $arrPost['partner'];
            }
            echo $this->renderAjax('_form', [
                'model' => $tr_materia,
            ]);
            exit();
        }
    }

    /**
     * Deletes an existing TrPartners model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     */
    public function actionDelete($id) {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the TrPartners model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return TrPartners the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = TrPartners::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

}
