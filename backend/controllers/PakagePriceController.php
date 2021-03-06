<?php

namespace backend\controllers;

use Yii;
use backend\models\PakagePrice;
use backend\models\PakagePriceSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use common\models\Language;
use backend\models\TrPakagePrice;

/**
 * PakagePriceController implements the CRUD actions for PakagePrice model.
 */
class PakagePriceController extends Controller
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
     * Lists all PakagePrice models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new PakagePriceSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single PakagePrice model.
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
     * Creates a new PakagePrice model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new PakagePrice();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $objLang = new Language();
                $languages = $objLang->find()->asArray()->all();
                foreach ($languages as $value) {
                    $trmodel = new TrPakagePrice();
                    $trmodel->title = $model->title;
                    $trmodel->description = $model->description;
                    $trmodel->short_description = $model->short_description;
                    $trmodel->pakage_price_id = $model->id;
                    $trmodel->language_id = $value['id'];
                    $trmodel->save();
                }
                Yii::$app->session->setFlash('success', 'Package successfully created');
                return $this->redirect(['update','id' => $model->id]);
        } else {
            $defaultLanguage = Language::find()->where(['is_default' => 1])->one();
            return $this->render('create', [
                        'model' => $model,
                        'defoultId' => $defaultLanguage->id
            ]);
        }
    }

    /**
     * Updates an existing PakagePrice model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
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
     * Deletes an existing PakagePrice model.
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
     * Finds the PakagePrice model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return PakagePrice the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = PakagePrice::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
