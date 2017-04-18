<?php

namespace backend\controllers;

use Yii;
use backend\models\TrBlog;
use backend\models\TrBlogSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * TrBlogController implements the CRUD actions for TrBlog model.
 */
class TrBlogController extends Controller {

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
     * Lists all TrBlog models.
     * @return mixed
     */
    public function actionIndex() {
        $searchModel = new TrBlogSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single TrBlog model.
     * @param string $id
     * @return mixed
     */
    public function actionView($id) {
        return $this->render('view', [
                    'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new TrBlog model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {
        $model = new TrBlog();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                        'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing TrBlog model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     */
    public function actionUpdate() {
        if (isset(Yii::$app->request->post()['TrBlog'])) {
            //echo "<pre>";print_r(Yii::$app->request->post());die;
            $model = new TrBlog();

            $arrPost = Yii::$app->request->post()['TrBlog'];

            $trModel = $model->findOne(['language_id' => $arrPost['language_id'], 'blog_id' => $arrPost['blog_id']]);
            if ($trModel) {
                $trModel->title = $arrPost['title'];
                $trModel->short_description = $arrPost['short_description'];
                $trModel->description = $arrPost['description'];
                $trModel->language_id = $arrPost['language_id'];
                $trModel->blog_id = $arrPost['blog_id'];
            } else {
                $trModel = new TrBlog();
                $trModel->title = $arrPost['title'];
                $trModel->short_description = $arrPost['short_description'];
                $trModel->description = $arrPost['description'];
                $trModel->language_id = $arrPost['language_id'];
                $trModel->blog_id = $arrPost['blog_id'];
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
            $tr_materialObj = new TrBlog();
            $tr_materia = $tr_materialObj->findOne(['language_id' => $arrPost['lang'], 'blog_id' => $arrPost['blog']]);

            if (!$tr_materia) {
                $tr_materia = new TrBlog();
                $tr_materia->language_id = $arrPost['lang'];
                $tr_materia->materials_id = $arrPost['material'];
            }
            echo $this->renderAjax('_form', [
                'model' => $tr_materia,
            ]);
            exit();
        }
    }

    /**
     * Deletes an existing TrBlog model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     */
    public function actionDelete($id) {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the TrBlog model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return TrBlog the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = TrBlog::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

}
