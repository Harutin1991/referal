<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\CalculatorSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Calculators');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="row">
    <div class="col-md-12">
        <div class="slider-index">
            <?= Html::a('<span class="fa fa-plus pr5"></span>' . Yii::t('app', 'Update Calculator'), ['/calculator/update?id=1'], ['class' => 'btn btn-system mb15']) ?>
        </div>
        <!-- recent orders table -->
        <div class="tray tray-center filter">
            <div class="panel">
                <div class="panel-body pn">
                    <div class="table-responsive">
                        <?=
                        GridView::widget([
                            'dataProvider' => $dataProvider,
//                        'filterModel' => $searchModel,
                            'tableOptions' => [
                                'class' => 'table admin-form theme-warning tc-checkbox-1 fs13',
                                'id' => 'tbl_how_to_earn'
                            ],
                            'filterRowOptions' => [
                                'role' => "row",
                            ],
                            'rowOptions' => [
                                'role' => "row",
                                'class' => 'odd'
                            ],
                            'summary' => false,
                            'options' => ['class' => 'br-r', 'id' => 'how_to_earn'],
                            'columns' => [
                                ['attribute' => 'title'],
                                ['attribute' => 'short_description',
                                    'format' => 'html',
                                    'filterInputOptions' => [
                                        'class' => 'form-control',
                                        'placeholder' => 'Search'
                                    ],
                                ],
                                ['class' => 'yii\grid\ActionColumn',
                                    'template' => '{update}',
                                    'contentOptions' => ['style' => 'width: 30%;'],
                                    'buttons' => [
                                        'update' => function ($url, $model) {
                                            return Html::a('<span class="glyphicon glyphicon-pencil"></span> ' . Yii::t('app', 'Update'), $url, [
                                                        'title' => Yii::t('app', 'Update'),
                                                        'aria-label' => Yii::t('app', 'Update'),
                                                        //'data-confirm' =>Yii::t('app', 'Are you sure! You whant delete this item?'),
                                                        //'data-method' =>'post',
                                                        //'data-pjax' => '0',
                                                        'data-key' => $model->id,
                                                        'class' => 'btn btn-info btn-xs fs12 br2 ml5 pull-right',
                                                        'style' => 'font-size: 15px;'
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

        <!-- end: .tray-center -->
    </div>
</div>