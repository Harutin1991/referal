<?php

namespace backend\controllers;

use Yii;
use backend\models\Faq;
use backend\models\FaqSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use common\models\Language;
use backend\models\TrFaq;

/**
 * FaqController implements the CRUD actions for Faq model.
 */
class FaqController extends Controller {

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
     * Lists all Faq models.
     * @return mixed
     */
    public function actionIndex() {
        $model = new Faq();
        $searchModel = new FaqSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $defaultLanguage = Language::find()->where(['is_default' => 1])->one();
        return $this->render('index', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
                    'model' => $model,
                    'defoultId' => $defaultLanguage->id
        ]);
    }

    /**
     * Displays a single Faq model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id) {
        return $this->render('view', [
                    'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Faq model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {
        if (Yii::$app->request->post()) {

            $faq = new Faq();
            $postData = Yii::$app->request->post('Faq');
            $faq->setAttributes($postData);
            $order = Faq::find() // AQ instance
                    ->select('max(ordering)') // we need only one column
                    ->scalar();
            $faq->ordering = $order ? $order + 1 : 1;
            if ($faq->save()) {
                $objLang = new Language();
                $languages = $objLang->find()->asArray()->all();
                foreach ($languages as $value) {
                        $model = new TrFaq();
                        $model->name = $faq->title;
                        $model->short_description = $faq->short_description;
                        $model->description = $faq->description;
                        $model->faq_id = $faq->id;
                        $model->language_id = $value['id'];
                        $model->save();
                }
                Yii::$app->session->setFlash('success', 'Faq successfully created');
                return $this->redirect(['update',
                            'id' => $faq->id,
                ]);
            }
        } else {
            $defaultLanguage = Language::find()->where(['is_default' => 1])->one();
            $model = new Faq();
            return $this->render('create', [
                        'model' => $model,
                        'defoultId' => $defaultLanguage->id
            ]);
        }


        $model = new Faq();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                        'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Faq model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id) {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $model->updateDefaultTranslate();
            return $this->redirect(['index']);
        } else {
            return $this->render('update', [
                        'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Faq model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id) {
        $tr_faqs = TrFaq::find()->where(['faq_id' => $id])->all();
        foreach ($tr_faqs as $tr_faq) {
            $tr_faq->delete();
        }
        if (TrFaq::find()->where(['faq_id' => $id])->count() == 0) {
            $this->findModel($id)->delete();
            Yii::$app->session->setFlash('success', 'Faq successfully removed');
            return $this->redirect(['index']);
        }
    }

    /**
     * Finds the Faq model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Faq the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = Faq::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

}
