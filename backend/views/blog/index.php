<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use common\components\TimeFormaterHelper;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\BlogSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Blogs');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="row">
    <div class="col-md-12">
        <div class="blog-index">

            <h1><?= Html::encode($this->title) ?></h1>

            <div class="tray tray-center filter">
                <div id="product-form_cont">
                    <?= Html::a(Yii::t('app', '<i class="fa fa-plus fa-plus-square pr5"></i>Create New Blog'), ['/blog/create'], ['class' => 'btn btn-responsive button-alignment btn-success mb15']) ?>
                </div>
                <div class="panel">
                    <div class="panel-body pn">
                        <div class="table-responsive">
                            <?=
                            GridView::widget([
                                'dataProvider' => $dataProvider,
//                        'filterModel' => $searchModel,
                                'tableOptions' => [
                                    'class' => 'table table-striped table-hover display dataTable no-footer',
                                    'id' => 'tbl_blog'
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
                                    [
                                        'attribute' => 'title',
                                    ],
                                    [
                                        'attribute' => 'short_description','format' => 'html',
                                    ],
                                    [
                                        'attribute' => 'status',
                                         'format' => 'html',
                                        'value' => function ($model) {
                                            if ($model->status == 0) {
                                                return '<span class="label label-sm label-danger">'.Yii::t('app','Pasive').'</span>';
                                            } else {
                                                return '<span class="label label-sm label-success">'.Yii::t('app','Approved').'</span>';
                                            }
                                        },
                                    ],
                                    [
                                        'attribute' => 'created_at',
                                        'value' => function($model) {
                                            return TimeFormaterHelper::convert($model->created_at);
                                        }
                                    ],
                                    ['class' => 'yii\grid\ActionColumn',
                                        'template' => '{delete}{update}',
                                        'buttons' => [
                                            'update' => function ($url, $model) {
                                                return Html::a('<span class="glyphicon glyphicon-pencil"></span> Edit', $url, [
                                                            'title' => Yii::t('app', 'Update'),
                                                            'aria-label' => Yii::t('app', 'Update'),
                                                            //'data-confirm' =>Yii::t('app', 'Are you sure! You whant delete this item?'),
                                                            //'data-method' =>'post',
                                                            //'data-pjax' => '0',
                                                            'data-key' => $model->id,
                                                            'class' => 'btn btn-info btn-xs fs12 br2 ml5 pull-right'
                                                ]);
                                            },
                                            'delete' => function ($url, $model) {
                                                return Html::a('<span class="glyphicon glyphicon-trash"></span> Delete', $url, [
                                                            'title' => Yii::t('app', 'Delete'),
                                                            'aria-label' => Yii::t('app', 'Delete'),
                                                            'data-confirm' => Yii::t('app', 'Are you sure! You whant delete this item?'),
                                                            'data-method' => 'post',
                                                            'data-pjax' => '0',
                                                            'data-key' => $model->id,
                                                            'class' => 'btn btn-danger btn-xs fs12 br2 ml5 pull-right'
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
