<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\UserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Users');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="row">
    <div class="col-md-12">
        <div class="blog-index">

            <h1><?= Html::encode($this->title) ?></h1>

            <div class="tray tray-center filter">
                <div id="product-form_cont">
                    <?= Html::a('<i class="fa fa-plus fa-plus-square pr5"></i>' . Yii::t('app', 'Add User'), ['/user/create'], ['class' => 'btn btn-responsive button-alignment btn-success mb15']) ?>
                </div>
                <div class="panel">
                    <div class="panel-body pn">
                        <div class="table-responsive">
                            <?=
                            GridView::widget([
                                'dataProvider' => $dataProvider,
//                        'filterModel' => $searchModel,
                                'tableOptions' => [
                                    'class' => 'table table-bordered',
                                    'id' => 'table'
                                ],
                                'filterRowOptions' => [
                                    'role' => "row"
                                ],
                                'rowOptions' => [
                                    'role' => "row",
                                    'class' => 'odd'
                                ],
                                'summary' => false,
                                'options' => ['class' => 'br-r',],
                                'columns' => [
                                    'username',
                                    'email',
                                    [
                                        'class' => 'yii\grid\ActionColumn',
                                        'template' => '{update}',
                                    ],
                                    'first_name',
                                    'last_name',
                                    'gender',
                                    'phone',
                                    'starting_amount',
                                    'purse',
                                ],
                            ]);
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php echo $this->registerJs("
           $('#table').dataTable();
 
"); ?>