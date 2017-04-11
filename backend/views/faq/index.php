<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\CategorySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Faq');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="row">
    <div class="col-md-12">
        <div class="blog-index">

            <h1><?= Html::encode($this->title) ?></h1>

            <div class="tray tray-center filter">
                <div id="product-form_cont">
                    <?= Html::a('<i class="fa fa-plus fa-plus-square pr5"></i>' . Yii::t('app', 'Create New Faq'), ['/faq/create'], ['class' => 'btn btn-responsive button-alignment btn-success mb15']) ?>
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



