<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\CategorySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Pages');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="row">
    <div class="col-md-12">
        <div class="blog-index">
            <div class="tray tray-center filter">
                <div id="product-form_cont">
                    <?= Html::a('<span class="fa fa-plus pr5"></span>'.Yii::t('app','Create New Page'), ['/pages/create'], ['class' => 'btn btn-system mb15']) ?>
                </div>
                <div class="panel">
                    <div class="panel-body pn">
                        <div class="table-responsive">
                            <?=
                            GridView::widget([
                                'dataProvider' => $dataProvider,
                                'tableOptions' => [
                                    'class' => 'table table-striped table-hover display dataTable no-footer',
                                    'id' => 'tbl_pages'
                                ],
                                'filterRowOptions' => [
                                    'role' => "row"
                                ],
                                'rowOptions' => [
                                    'role' => "row",
                                    'class' => 'odd ui-state-default'
                                ],
                                'summary' => false,
                                'options' => ['class' => 'br-r', 'id' => 'category'],
                                'columns' => [
//            ['class' => 'yii\grid\SerialColumn'],
//            'id',
                                    ['attribute' => 'title',
                                        'filterInputOptions' => [
                                            'class' => 'form-control',
                                            'placeholder' => 'Search'
                                        ],
                                    ],
                                    ['class' => 'yii\grid\ActionColumn',
                                        'template' => '{createsubpage}{subpages}{update}{delete}',
                                        'contentOptions' => ['style' => 'width: 55%;'],
                                        'buttons' => [
                                            'createsubpage'=>function($url, $model){
                                                $url = \yii\helpers\Url::toRoute(['pages/create-subpage', 'id' => $model->id]);
                                                return Html::a('<span class="fa fa-plus-circle"></span>'.Yii::t('app','Create Sub Page'), $url, [
                                                            'title' => Yii::t('app','Create Sub Page'),
                                                            'aria-label' => Yii::t('app','Create Sub Page'),
                                                            'class' => 'btn btn-success btn-xs fs12 br2 ml5',
                                                            'style'=>'font-size: 14px;'
                                                ]);
                                            },
                                            'subpages'=>function($url, $model){
                                                $url = \yii\helpers\Url::toRoute(['pages/sub-pages', 'id' => $model->id]);
                                                return Html::a('<span class="fa fa-eye-slash"></span>'.Yii::t('app','Sub Pages'), $url, [
                                                            'title' => Yii::t('app','Sub Pages'),
                                                            'aria-label' => Yii::t('app','Sub Pages'),
                                                            'class' => 'btn btn-primary btn-xs fs12 br2 ml5',
                                                            'style'=>'font-size: 14px;'
                                                ]);
                                            },
                                            'update' => function ($url, $model) {
                                                return Html::a('<span class="glyphicon glyphicon-edit"></span> '.Yii::t('app', 'Update'), $url, [
                                                            'title' => 'Edit',
                                                            'aria-label' => 'Edit',
                                                            'data-key' => $model->id,
                                                            'class' => 'btn btn-info btn-xs fs12 br2 ml5',
                                                            'style'=>'font-size: 14px;'
                                                ]);
                                            },
                                            'delete' => function ($url, $model) {
                                                return Html::a('<span class="glyphicon glyphicon-trash"></span> '.Yii::t('app', 'Delete'), $url, [
                                                            'title' => 'Delete',
                                                            'aria-label' => 'Delete',
                                                            'data-confirm' => 'Are you sure! You whant delete this item?',
                                                            'data-method' => 'post',
                                                            'data-pjax' => '0',
                                                            'data-key' => $model->id,
                                                            'class' => 'btn btn-danger btn-xs fs12 br2 ml5',
                                                            'style'=>'font-size: 14px;'
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
