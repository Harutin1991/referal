<?php

namespace backend\controllers;


use Yii;
use common\models\Zones;
use common\models\ZonesSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use common\models\Countries;
use common\models\ZoneCountries;
use common\models\ZonePrices;
use yii\db\Query;

/**
 * ZonesController implements the CRUD actions for Zones model.
 */
class ZonesController extends Controller
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
     * Lists all Zones models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ZonesSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

        /**
     * Displays a single Zones model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Zones model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Zones();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
                'countryForm'=>'',
                'priceForm'=>''
            ]);
        }
    }

    /**
     * Updates an existing Zones model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        //$arrCounties = Countries::findAll(['status'=>1]);
        $query = (new Query());
        $query->select('countries.*, zone_countries.zone_id');
        $query->from('countries');
        $query->where(['status'=>1]);
        $query->leftJoin('zone_countries','zone_countries.country_id = countries.id AND zone_countries.zone_id ='.$id);
        $arrCounties = $query->all();

        $countryForm = $this->renderPartial('tabs/zone_countries',['arrCountries'=>$arrCounties,'id'=>$id]);
        $arrZones = ZonePrices::findAll(['zone_id'=>$id]);
        $priceForm =  $this->renderPartial('tabs/zone_prices',['arrZones'=>$arrZones,'id'=>$id]);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {

            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
                'countryForm'=>$countryForm,
                'priceForm'=>$priceForm
            ]);
        }
    }
    
    public function actionAddPrice(){
        $post = Yii::$app->request->post();

        Yii::$app->db->createCommand()->insert('zone_prices',$post)->execute();
        $arrZones = ZonePrices::findAll(['zone_id'=>$post['zone_id']]);

        $priceForm =  $this->renderPartial('tabs/zone_prices',['arrZones'=>$arrZones,'id'=>$post['zone_id']]);
        echo $priceForm; exit();



    }

    public function actionUpdatePrice(){
        $post = Yii::$app->request->post();
        $id= $post['id'];
        Yii::$app->db->createCommand()->update('zone_prices',$post, ['id'=>$id])->execute();
        $arrZones = ZonePrices::findAll(['zone_id'=>$post['zone_id']]);

        $priceForm =  $this->renderPartial('tabs/zone_prices',['arrZones'=>$arrZones,'id'=>$post['zone_id']]);
        echo $priceForm; exit();



    }

    
    public function actionDeletePrice(){
        $post = Yii::$app->request->post();
        $id = (int) $post['id'];
        Yii::$app->db->createCommand()->delete('zone_prices',['id'=> $id])->execute();
        $arrZones = ZonePrices::findAll(['zone_id'=>$post['zone_id']]);

        $priceForm =  $this->renderPartial('tabs/zone_prices',['arrZones'=>$arrZones,'id'=>$post['zone_id']]);
        echo $priceForm; exit();



    }
    
    public function actionUpdateZoneCountries(){
        $arrPost = Yii::$app->request->post();
        if(!empty($arrPost) && isset($arrPost['countries'])){
            $objZoneCountry = new ZoneCountries();
            $objZones =$objZoneCountry->findAll(['zone_id'=>$arrPost['zone']]);
            if($objZones){
                $objZoneCountry->deleteAll(['zone_id'=>$arrPost['zone']]);
            }
            foreach ($arrPost['countries'] as $value){
                $arrInsert[] = [$arrPost['zone'],$value];
            }
            if(Yii::$app->db->createCommand()->batchInsert('zone_countries',['zone_id','country_id'],$arrInsert)->execute()){
                $this->redirect(['update','id'=>$arrPost['zone']]);
            };



        }
    }

    /**
     * Deletes an existing Zones model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Zones model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Zones the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Zones::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
