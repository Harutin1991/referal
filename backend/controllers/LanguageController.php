<?php

namespace backend\controllers;

use Yii;
use common\models\Language;
use backend\models\LanguageSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use backend\models\User;

/**
 * LanguageController implements the CRUD actions for Language model.
 */
class LanguageController extends Controller {

    /**
     * @inheritdoc
     */
    public function behaviors() {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'index' => ['GET', 'POST'],
                    'view' => ['GET'],
                    'delete' => ['POST'],
                ],
            ],
            'access' => [
                'class' => AccessControl::className(),
                'ruleConfig' => [
                    'class' => 'common\components\CAccessRule',
                ],
                'only' => ['index', 'view', 'create', 'update', 'delete'],
                'rules' => [
                    // allow authenticated users
                    [
                        'actions' => ['index', 'view', 'create', 'update', 'delete'],
                        'allow' => true,
                        // Allow users, moderators and admins to create
                        'roles' => [
                            User::ADMIN,
                        ],
                    ],
                // everything else is denied
                ],
            ],
        ];
    }

    /**
     * Lists all Language models.
     * @return mixed
     */
    public function actionIndex() {
        $searchModel = new LanguageSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Language model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id) {
        return $this->render('view', [
                    'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Language model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {
        $model = new Language();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $languageAll = Language::find()->select('short_code')->asArray()->all();
            foreach($languageAll as $lang){
                $content[] = $lang['short_code'];
            }
            $path = Yii::$app->basePath . "/../frontend/config";
            $filePath = $path . '/language.json';
            if (!file_exists($filePath)) {
                $fp = fopen($filePath, "w+");
                fwrite($fp, json_encode($content));
                fclose($fp);
            } else {
                unlink($filePath);
                $fp = fopen($filePath, "w+");
                fwrite($fp, json_encode($content));
                fclose($fp);
            }
            return $this->redirect('index');
        } else {
            return $this->render('create', [
                        'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Language model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id) {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $languageAll = Language::find()->select('short_code')->asArray()->all();
            foreach($languageAll as $lang){
                $content[] = $lang['short_code'];
            }
            $path = Yii::$app->basePath . "/../frontend/config";
            $filePath = $path . '/language.json';
            if (!file_exists($filePath)) {
                $fp = fopen($filePath, "w+");
                fwrite($fp, json_encode($content));
                fclose($fp);
            } else {
                unlink($filePath);
                $fp = fopen($filePath, "w+");
                fwrite($fp, json_encode($content));
                fclose($fp);
            }
            return $this->redirect('index');
        } else {
            return $this->render('update', [
                        'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Language model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id) {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Language model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Language the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = Language::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

}
