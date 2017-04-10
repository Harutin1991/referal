<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\BlogCategoriesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Blog Categories');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="row">
    <div class="col-md-12">
        <div class="blog-index">

            <h1><?= Html::encode($this->title) ?></h1>

            <div class="tray tray-center filter">
                <div id="product-form_cont">
                    <?= Html::a('<span class="fa fa-plus pr5"></span>' . Yii::t('app', 'Create Blog Categories'), ['create'], ['class' => 'btn btn-system mb15']) ?>
                </div>
                <div class="panel">
                    <div class="panel-body pn">
                        <div class="table-responsive">
                            <?=
                            GridView::widget([
                                'dataProvider' => $dataProvider,
//                        'filterModel' => $searchModel,
                                'tableOptions' => [
                                    'class' => 'table admin-form theme-warning tc-checkbox-1 fs13',
                                    'id' => 'tbl_event'
                                ],
                                'filterRowOptions' => [
                                    'role' => "row",
                                ],
                                'rowOptions' => [
                                    'role' => "row",
                                    'class' => 'odd'
                                ],
                                'summary' => false,
                                'options' => ['class' => 'br-r', 'id' => 'event'],
                                'columns' => [
                                    ['attribute' => 'title',
                                        'format' => 'html',
                                        'value' => function ($model) {
                                            $url = \yii\helpers\Url::toRoute(['events/index', 'id' => $model->id]);
                                            return Html::a($model->title, 'javascript: void(0);', ['class' => 'link']);
                                        },
                                        'filterInputOptions' => [
                                            'class' => 'form-control',
                                            'placeholder' => 'Search'
                                        ],
                                    ],
                                    [
                                        'attribute' => 'created_at',
                                        'value' => function($model) {
                                            return TimeFormaterHelper::convert($model->created_at);
                                        }
                                    ],
                                    ['class' => 'yii\grid\ActionColumn',
                                        'template' => '{update}{delete}',
                                        'buttons' => [
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
                                            'update' => function ($url, $model) {
                                                return Html::a('<span class="glyphicon glyphicon-pencil"></span> Edit', $url, [
                                                            'title' => 'Edit',
                                                            'aria-label' => 'Edit',
                                                            //'data-confirm' => 'Are you sure! You whant delete this item?',
                                                            //'data-method' => 'post',
                                                            'data-pjax' => '0',
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
