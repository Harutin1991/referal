<?php

namespace backend\controllers;

use Yii;
use backend\models\TrAboutus;
use backend\models\Aboutus;
use backend\models\TrAboutusSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * TrAboutusController implements the CRUD actions for TrAboutus model.
 */
class TrAboutusController extends Controller
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
     * Lists all TrAboutus models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new TrAboutusSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single TrAboutus model.
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
     * Creates a new TrAboutus model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new TrAboutus();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing TrAboutus model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     */
    public function actionUpdate() {

        if (isset(Yii::$app->request->post()['TrAboutus'])) {

            $model = new TrAboutus();

            $arrPost = Yii::$app->request->post()['TrAboutus'];
            $trModel = $model->findOne(['language_id' => $arrPost['language_id'], 'aboutus_id' => $arrPost['aboutus_id']]);
            if ($trModel) {
                $trModel->title = $arrPost['title'];
                $trModel->description = $arrPost['description'];
                $trModel->short_description = $arrPost['short_description'];
                $trModel->language_id = $arrPost['language_id'];
                $trModel->aboutus_id = $arrPost['aboutus_id'];
            } else {
                $trModel = new TrAboutus();
                $trModel->title = $arrPost['title'];
                $trModel->description = $arrPost['description'];
                $trModel->short_description = $arrPost['short_description'];
                $trModel->language_id = $arrPost['language_id'];
                $trModel->aboutus_id = $arrPost['aboutus_id'];
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
           
            $tr_attributeObj = new TrAboutus();
            $tr_attribute = $tr_attributeObj->findOne(['language_id' => $arrPost['lang'], 'aboutus_id' => $arrPost['about']]);

            if (!$tr_attribute) {
                $tr_attribute = new TrAboutus();
                $about = Aboutus::findOne(['id'=>$arrPost['about']]);
                $tr_attribute->title = $about->title;
                $tr_attribute->description = $about->description;
                $tr_attribute->short_description =  $about->short_description;
                $tr_attribute->language_id = $arrPost['lang'];
                $tr_attribute->aboutus_id = $arrPost['about'];
            }
            echo $this->renderPartial('_form', [
                'model' => $tr_attribute,
            ]);
            exit();
        }
    }

    /**
     * Deletes an existing TrAboutus model.
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
     * Finds the TrAboutus model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return TrAboutus the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = TrAboutus::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
