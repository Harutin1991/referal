<?php

namespace backend\controllers;

use Yii;
use backend\models\TrEvents;
use backend\models\TrEventsSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * TrEventsController implements the CRUD actions for TrEvents model.
 */
class TrEventsController extends Controller
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
     * Lists all TrEvents models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new TrEventsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single TrEvents model.
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
     * Creates a new TrEvents model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new TrEvents();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing TrEvents model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     */
    
    public function actionUpdate() {
        if (isset(Yii::$app->request->post()['TrEvents'])) {

            $model = new TrEvents();

            $arrPost = Yii::$app->request->post()['TrEvents'];
            
            $trModel = $model->findOne(['language_id' => $arrPost['language_id'], 'events_id' => $arrPost['events_id']]);
            if ($trModel) {
                $trModel->name = $arrPost['name'];
                $trModel->short_description = $arrPost['short_description'];
                $trModel->description = $arrPost['description'];
                $trModel->language_id = $arrPost['language_id'];
                $trModel->events_id = $arrPost['events_id'];
            } else {
                $trModel = new TrEvents();
                $trModel->name = $arrPost['name'];
                $trModel->short_description = $arrPost['short_description'];
                $trModel->description = $arrPost['description'];
                $trModel->language_id = $arrPost['language_id'];
                $trModel->events_id = $arrPost['events_id'];
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
            $tr_materialObj = new TrEvents();
            $tr_materia = $tr_materialObj->findOne(['language_id' => $arrPost['lang'], 'events_id' => $arrPost['event']]);

            if (!$tr_materia) {
                $tr_materia = new TrEvents();
                $tr_materia->language_id = $arrPost['lang'];
                $tr_materia->events_id = $arrPost['event'];
            }
            echo $this->renderAjax('_form', [
                'model' => $tr_materia,
            ]);
            exit();
        }
    }

    /**
     * Deletes an existing TrEvents model.
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
     * Finds the TrEvents model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return TrEvents the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = TrEvents::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
