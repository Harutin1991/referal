<?php

namespace backend\controllers;

use Yii;
use backend\models\TrPakagePrice;
use backend\models\TrPakagePriceSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * TrPakagePriceController implements the CRUD actions for TrPakagePrice model.
 */
class TrPakagePriceController extends Controller
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
     * Lists all TrPakagePrice models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new TrPakagePriceSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single TrPakagePrice model.
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
     * Creates a new TrPakagePrice model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new TrPakagePrice();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing TrPakagePrice model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     */
    public function actionUpdate() {

        if (isset(Yii::$app->request->post()['TrPakagePrice'])) {

            $model = new TrPakagePrice();

            $arrPost = Yii::$app->request->post()['TrPakagePrice'];
            $trModel = $model->findOne(['language_id' => $arrPost['language_id'], 'pakage_price_id' => $arrPost['pakage_price_id']]);

            if ($trModel) {
                $trModel->title = $arrPost['title'];
                $trModel->short_description = $arrPost['short_description'];
                $trModel->description = $arrPost['description'];
                $trModel->language_id = $arrPost['language_id'];
                $trModel->pakage_price_id = $arrPost['pakage_price_id'];
            } else {
                $trModel = new TrPakagePrice();
                $trModel->title = $arrPost['title'];
                $trModel->description = $arrPost['description'];
                $trModel->short_description = $arrPost['short_description'];
                $trModel->language_id = $arrPost['language_id'];
                $trModel->pakage_price_id = $arrPost['pakage_price_id'];
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
            $tr_pagesObj = new TrPakagePrice();
            $tr_pages = $tr_pagesObj->findOne(['language_id' => $arrPost['lang'], 'pakage_price_id' => $arrPost['pakage_price_id']]);

            if (!$tr_pages) {
                $tr_pages = new TrPakagePrice();
                $tr_pages->language_id = $arrPost['lang'];
                $tr_pages->pakage_price_id = $arrPost['pakage_price_id'];
            }
            echo $this->renderPartial('_form', [
                'model' => $tr_pages,
            ]);
            exit();
        }
    }

    /**
     * Deletes an existing TrPakagePrice model.
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
     * Finds the TrPakagePrice model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return TrPakagePrice the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = TrPakagePrice::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
