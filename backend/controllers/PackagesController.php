<?php

namespace backend\controllers;

use Yii;
use backend\models\Packages;
use backend\models\PackagesSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use backend\models\User;
use backend\models\PackageMessages;

/**
 * PackagesController implements the CRUD actions for Packages model.
 */
class PackagesController extends Controller
{ 
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
     * Lists all Pakages models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new PackagesSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Pakages model.
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
     * Creates a new Pakages model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Packages();
        $modelMessage = new PackageMessages();
        if ($model->load(Yii::$app->request->post()) && $modelMessage->load(Yii::$app->request->post())) {
            echo "<pre>";print_r(Yii::$app->request->post());die;
            $model->created_date = time();
            $model->updated_date = time();
            if($model->save()){
                $modelMessage->save();
            }
            return $this->redirect('index');
        } else {
            
            return $this->render('create', [
                'model' => $model,
                'modelMessage' => $modelMessage,
            ]);
        }
    }
    
    public function actionCreatePackageMessage(){
        if (Yii::$app->request->isAjax) {
            $data = Yii::$app->request->post();
            $modelMessage = new PackageMessages();
            $modelMessage->package_id = $data['packageId'];
            $modelMessage->message = $data['message'];
            if($modelMessage->save()){
                echo json_encode(['success'=>true,'messageID'=>$modelMessage->id]);exit();
            }
            echo json_encode(['success'=>false]);exit();
        }
    }
    public function actionEditPackageMessage(){
        if (Yii::$app->request->isAjax) {
             $data = Yii::$app->request->post();
             $modelMessage = PackageMessages::findOne($data['messageId']);
             $modelMessage->message = $data['message'];
             if($modelMessage->save()){
                echo json_encode(['success'=>true]);exit();
            }
            echo json_encode(['success'=>false]);exit();
        }
    }
    public function actionDeletePackageMessage(){
        if (Yii::$app->request->isAjax) {
            $data = Yii::$app->request->post();
            $modelMessage = PackageMessages::findOne($data['messageID'])->delete();
            if($modelMessage){
                echo json_encode(['success'=>true]);exit();
            }
            echo json_encode(['success'=>false]);exit();
        }
    }

    /**
     * Updates an existing Pakages model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post())) {
            $model->created_date = time();
            $model->updated_date = time();
            $model->save();
            return $this->redirect('index');
        } else {
            $packageMessages = PackageMessages::find()->where(['package_id'=>$id])->asArray()->all();
            return $this->render('update', [
                'model' => $model,
                'packageMessages' => $packageMessages,
            ]);
        }
    }

    /**
     * Deletes an existing Pakages model.
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
     * @return mixed
     */
    public function actionUpdateOrdering() {
        if (Yii::$app->request->isAjax) {
            $model = new Packages();
            $data = Yii::$app->request->post();
            return $model->bachUpdate($data);
        }
    }
    /**
     * Finds the Packages model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return Packages the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Packages::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
