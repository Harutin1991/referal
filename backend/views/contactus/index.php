<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\ContactusSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Contact Us');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="table-layout">
    <div class="tray tray-center filter">
        <div class="panel">
            <div class="panel-body pn">
                <div class="table-responsive">
                    <?=
                    GridView::widget([
                        'dataProvider' => $dataProvider,
//                        'filterModel' => $searchModel,
                        'tableOptions' => [
                            'class' => 'table table-striped admin-form table-hover display dataTable no-footer',
                            'id' => 'tbl_attr'
                        ],
                        'filterRowOptions' => [
                            'role' => "row",
                        ],
                        'rowOptions' => [
                            'role' => "row",
                            'class' => 'odd'
                        ],
                        'summary' => false,
                        'options' => ['class' => 'br-r', 'id' => 'product'],
                        'columns' => [
                            [
                                'attribute' => 'email', 'format' => 'email',
                            ],
                            ['class' => 'yii\grid\ActionColumn',
                                'template' => '{update}',
                                'buttons' => [
                                    'update' => function ($url, $model) {
                                        return Html::a('<span class="glyphicon glyphicon-pencil"></span> '.Yii::t('app','Update'), $url, [
                                                    'title' => Yii::t('app', 'Update'),
                                                    'aria-label' => Yii::t('app', 'Update'),
                                                    //'data-confirm' =>Yii::t('app', 'Are you sure! You whant delete this item?'),
                                                    //'data-method' =>'post',
                                                    //'data-pjax' => '0',
                                                    'data-key' => $model->id,
                                                    'class' => 'btn btn-info btn-xs fs12 br2 ml5 pull-right',
                                                    'style'=>'font-size:15px'
                                        ]);
                                    }
                                ]
                            ],
                        ],
                    ]);
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>
