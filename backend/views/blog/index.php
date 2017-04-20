<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use common\components\TimeFormaterHelper;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\BlogSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '<h1 style="display: inline;margin-left: 8px; margin-right: 10px;">'.Yii::t('app', 'Blogs').'</h1>  '. Html::a('<i class="fa fa-plus fa-plus-square pr5"></i>'.Yii::t('app', 'Create New Blog'), ['/blog/create'], ['class' => 'btn btn-responsive button-alignment btn-success']);
$this->params['breadcrumbs'][] = Yii::t('app', 'Blogs');
?>
<div class="row">
    <div class="col-md-12">
        <div class="blog-index">

            <div class="tray tray-center filter">
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
                                        'attribute' => 'created_at',
                                        'value' => function($model) {
                                            return TimeFormaterHelper::convert($model->created_at);
                                        }
                                    ],
                                    ['class' => 'yii\grid\ActionColumn',
                                        'template' => '{delete}{update}',
                                        'buttons' => [
                                            'update' => function ($url, $model) {
                                                return Html::a('<span class="glyphicon glyphicon-pencil"></span> '.Yii::t('app', 'Update'), $url, [
                                                            'title' => Yii::t('app', 'Update'),
                                                            'aria-label' => Yii::t('app', 'Update'),
                                                            //'data-confirm' =>Yii::t('app', 'Are you sure! You whant delete this item?'),
                                                            //'data-method' =>'post',
                                                            //'data-pjax' => '0',
                                                            'data-key' => $model->id,
                                                            'class' => 'btn btn-info btn-xs fs12 br2 ml5 pull-right',
                                                            'style'=>'font-size: 15px;'
                                                ]);
                                            },
                                            'delete' => function ($url, $model) {
                                                return Html::a('<span class="glyphicon glyphicon-trash"></span> '.Yii::t('app', 'Delete'), $url, [
                                                            'title' => Yii::t('app', 'Delete'),
                                                            'aria-label' => Yii::t('app', 'Delete'),
                                                            'data-confirm' => Yii::t('app', 'Are you sure! You whant delete this item?'),
                                                            'data-method' => 'post',
                                                            'data-pjax' => '0',
                                                            'data-key' => $model->id,
                                                            'class' => 'btn btn-danger btn-xs fs12 br2 ml5 pull-right',
                                                            'style'=>'font-size: 15px;'
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
<?php
$this->registerJs('
 $("#tbl_blog").sortable({
            connectWith: ".portlet",
            items: ".portlet",
            opacity: 0.8,
            coneHelperSize: true,
            placeholder: "sortable-box-placeholder round-all",
            forcePlaceholderSize: true,
            tolerance: "pointer"
        });
        $(".column").disableSelection();
')
?>
