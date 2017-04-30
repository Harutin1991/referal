<?php

namespace backend\controllers;

use Yii;
use backend\models\InvestorPackages;
use backend\models\InvestorPackagesSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use backend\models\User;
use common\models\Language;

/**
 * InvestorPackagesController implements the CRUD actions for InvestorPackages model.
 */
class InvestorPackagesController extends Controller {

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
                    'create' => ['POST', 'GET'],
                    'update' => ['POST', 'GET'],
                    'delete' => ['POST', 'GET'],
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
     * Lists all InvestorPackages models.
     * @return mixed
     */
    public function actionIndex() {
        $searchModel = new InvestorPackagesSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single InvestorPackages model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id) {
        return $this->render('view', [
                    'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new InvestorPackages model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {
        $model = new InvestorPackages();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect('index');
        } else {
            return $this->render('create', [
                        'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing InvestorPackages model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id) {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect('index');
        } else {
            return $this->render('update', [
                        'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing InvestorPackages model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id) {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the InvestorPackages model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return InvestorPackages the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = InvestorPackages::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    /**
     * @return mixed
     */
    public function actionUpdateOrdering() {
        if (Yii::$app->request->isAjax) {
            $model = new InvestorPackages();
            $data = Yii::$app->request->post();
            return $model->bachUpdate($data);
        }
    }

}
