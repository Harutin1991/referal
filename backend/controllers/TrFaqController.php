<?php

namespace backend\controllers;

use Yii;
use backend\models\TrFaq;
use backend\models\TrFaqSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * TrFaqController implements the CRUD actions for TrFaq model.
 */
class TrFaqController extends Controller {

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
     * Lists all TrFaq models.
     * @return mixed
     */
    public function actionIndex() {
        $searchModel = new TrFaqSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single TrFaq model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id) {
        return $this->render('view', [
                    'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new TrFaq model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {
        $model = new TrFaq();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                        'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing TrFaq model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate() {

        if (isset(Yii::$app->request->post()['TrFaq'])) {

            $model = new TrFaq();

            $arrPost = Yii::$app->request->post()['TrFaq'];
            $trModel = $model->findOne(['language_id' => $arrPost['language_id'], 'faq_id' => $arrPost['faq_id']]);
            if ($trModel) {
                $trModel->name = $arrPost['name'];
                $trModel->short_description = $arrPost['short_description'];
                $trModel->description = $arrPost['description'];
                $trModel->language_id = $arrPost['language_id'];
                $trModel->faq_id = $arrPost['faq_id'];
            } else {
                $trModel = new TrFaq();
                $trModel->name = $arrPost['name'];
                $trModel->short_description = $arrPost['short_description'];
                $trModel->description = $arrPost['description'];
                $trModel->language_id = $arrPost['language_id'];
                $trModel->faq_id = $arrPost['faq_id'];
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
            $tr_faqObj = new TrFaq();
            $tr_faq = $tr_faqObj->findOne(['language_id' => $arrPost['lang'], 'faq_id' => $arrPost['faq']]);

            if (!$tr_faq) {
                $tr_faq = new TrFaq();
                $tr_faq->language_id = $arrPost['lang'];
                $tr_faq->faq_id = $arrPost['faq'];
            }
            echo $this->renderPartial('_form', [
                'model' => $tr_faq,
            ]);
            exit();
        }
    }

    /**
     * Deletes an existing TrFaq model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id) {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the TrFaq model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return TrFaq the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = TrFaq::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

}
