<?php

namespace backend\controllers;

use Yii;
use backend\models\TrSitesettings;
use backend\models\TrSitesettingsSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * TrSitesettingsController implements the CRUD actions for TrSitesettings model.
 */
class TrSitesettingsController extends Controller {

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
     * Lists all TrSitesettings models.
     * @return mixed
     */
    public function actionIndex() {
        $searchModel = new TrSitesettingsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single TrSitesettings model.
     * @param string $id
     * @return mixed
     */
    public function actionView($id) {
        return $this->render('view', [
                    'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new TrSitesettings model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {
        $model = new TrSitesettings();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                        'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing TrSitesettings model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     */
    public function actionUpdate() {
        if (isset(Yii::$app->request->post()['TrSitesettings'])) {

            $model = new TrSitesettings();

            $arrPost = Yii::$app->request->post()['TrSitesettings'];

            $trModel = $model->findOne(['language_id' => $arrPost['language_id'], 'settings_id' => $arrPost['settings_id']]);
            if ($trModel) {
                $trModel->logoText = $arrPost['logoText'];
                //$trModel->logoDescription = $arrPost['logoDescription'];
                $trModel->language_id = $arrPost['language_id'];
                $trModel->settings_id = $arrPost['settings_id'];
            } else {
                $trModel = new TrSitesettings();
                $trModel->logoText = $arrPost['logoText'];
                //$trModel->logoDescription = $arrPost['logoDescription'];
                $trModel->language_id = $arrPost['language_id'];
                $trModel->settings_id = $arrPost['settings_id'];
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
            $tr_materialObj = new TrSitesettings();
            $tr_materia = $tr_materialObj->findOne(['language_id' => $arrPost['lang'], 'settings_id' => $arrPost['settings']]);

            if (!$tr_materia) {
                $tr_materia = new TrSitesettings();
                $tr_materia->language_id = $arrPost['lang'];
                $tr_materia->settings_id = $arrPost['settings'];
            }
            echo $this->renderAjax('_form', [
                'model' => $tr_materia,
            ]);
            exit();
        }
    }

    /**
     * Deletes an existing TrSitesettings model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     */
    public function actionDelete($id) {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the TrSitesettings model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return TrSitesettings the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = TrSitesettings::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

}
