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
            <div class="header" style="margin-bottom: 10px;">
            <h1 style="display:inline;"><?= Html::encode($this->title) . ' ' . Yii::t('app', 'Table') ?></h1>
            <?= Html::a('<i class="fa fa-plus fa-plus-square pr5"></i>' . Yii::t('app', 'Add User'), ['/user/create'], ['class' => 'btn btn-responsive button-alignment btn-success mb15 pull-right']) ?>
            </div>
            <div class="tray tray-center filter">
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
                                    'first_name',
                                    'last_name',
                                    'gender',
                                    'phone',
                                    'starting_amount',
                                    'purse',
                                    ['class' => 'yii\grid\ActionColumn',
                                        'template' => '{update}{delete}',
                                        //   'contentOptions' => ['style' => 'width: 20%;'],
                                        'buttons' => [
                                            'delete' => function ($url, $model) {
                                                return Html::a('<span class="glyphicon glyphicon-trash"></span> Delete', $url, [
                                                            'title' => 'Delete',
                                                            'aria-label' => 'Delete',
                                                            'data-confirm' => 'Are you sure! You whant delete this item?',
                                                            'data-key' => $model->id,
                                                            'class' => 'btn btn-danger btn-xs fs12 br2 ml5'
                                                ]);
                                            },
                                                    'update' => function ($url, $model) {
                                                return Html::a('<span class="glyphicon glyphicon-pencil"></span> Edit', $url, [
                                                            'title' => 'Edit',
                                                            'aria-label' => 'Edit',
                                                            //'data-confirm' => 'Are you sure! You whant delete this item?',
                                                            //'data-method' => 'post',
                                                            'data-key' => $model->id,
                                                            'class' => 'btn btn-info btn-xs fs12 br2 ml5'
                                                ]);
                                            },
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
            </div>
        </div>