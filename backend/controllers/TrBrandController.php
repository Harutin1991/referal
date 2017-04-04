<?php

namespace backend\controllers;

use Yii;
use backend\models\TrBrand;
use backend\models\TrBrandSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * TrBrandController implements the CRUD actions for TrBrand model.
 */
class TrBrandController extends Controller {

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
     * Lists all TrBrand models.
     * @return mixed
     */
    public function actionIndex() {
        $searchModel = new TrBrandSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single TrBrand model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id) {
        return $this->render('view', [
                    'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new TrBrand model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {
        $model = new TrBrand();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                        'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing TrBrand model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate() {

        if (isset(Yii::$app->request->post()['TrBrand'])) {

            $model = new TrBrand();

            $arrPost = Yii::$app->request->post()['TrBrand'];
            $trModel = $model->findOne(['language_id' => $arrPost['language_id'], 'brand_id' => $arrPost['brand_id']]);

            if ($trModel) {
                $trModel->name = $arrPost['name'];
                $trModel->description = $arrPost['description'];
                $trModel->short_description = $arrPost['short_description'];
            } else {
                
                $trModel = new TrBrand();
                $trModel->name = $arrPost['name'];
                $trModel->language_id = $arrPost['language_id'];
                $trModel->brand_id = $arrPost['brand_id'];
                $trModel->description = $arrPost['description'];
                $trModel->short_description = $arrPost['short_description'];
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
            $tr_brandObj = new TrBrand();
            $tr_brand = $tr_brandObj->findOne(['language_id' => $arrPost['lang'], 'brand_id' => $arrPost['brand']]);

            if (!$tr_brand) {
                $tr_brand = new TrBrand();
                $tr_brand->language_id = $arrPost['lang'];
                $tr_brand->description = $arrPost['description'];
                $tr_brand->short_description = $arrPost['short_description'];
                $tr_brand->brand_id = $arrPost['brand'];
            }
            echo $this->renderPartial('_form', [
                'model' => $tr_brand,
            ]);
            exit();
        }
    }

    /**
     * Deletes an existing TrBrand model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id) {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the TrBrand model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return TrBrand the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = TrBrand::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

}
