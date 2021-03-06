<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\PakagePriceSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Package Prices');
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="row">
    <div class="col-md-12">
        <div class="blog-index">

            <h1><?= Html::encode($this->title) ?></h1>

            <div class="tray tray-center filter">
                <div id="product-form_cont">
                    <?= Html::a(Yii::t('app', '<span class="fa fa-plus pr5"></span>'.Yii::t('app','Create Package Price')), ['/pakage-price/create'], ['class' => 'btn btn-system mb15']) ?>
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
                                    ['attribute' => 'short_description',
                                        'filterInputOptions' => [
                                            'class' => 'form-control',
                                        ],
                                    ],
                                    ['class' => 'yii\grid\ActionColumn',
                                        'template' => '{update}{delete}',
                                        'buttons' => [
                                            'update' => function ($url, $model) {
                                                return Html::a('<span class="glyphicon glyphicon-edit"></span> Edit', $url, [
                                                            'title' => 'Edit',
                                                            'aria-label' => 'Edit',
                                                            'data-key' => $model->id,
                                                            'class' => 'btn btn-info btn-xs fs12 br2 ml5'
                                                ]);
                                            },
                                            'delete' => function ($url, $model) {
                                                return Html::a('<span class="glyphicon glyphicon-trash"></span> Delete', $url, [
                                                            'title' => 'Delete',
                                                            'aria-label' => 'Delete',
                                                            'data-confirm' => 'Are you sure! You whant delete this item?',
                                                            'data-method' => 'post',
                                                            'data-pjax' => '0',
                                                            'data-key' => $model->id,
                                                            'class' => 'btn btn-danger btn-xs fs12 br2 ml5'
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
