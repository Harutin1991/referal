<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\ServiceSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Services');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="table-layout">
    <div class="tray tray-center filter">
        <!-- recent orders table -->
        <div id="category-form_cont">
            <?= Html::a(Yii::t('app', '<span class="fa fa-plus pr5"></span> Create Service'), ['/service/create'], ['class' => 'btn btn-system mb15']) ?>
        </div>
        <div class="panel">
            <div class="panel-body pn">
                <div class="table-responsive">
                    <?php Pjax::begin(['id' => 'servicePjaxtbl']) ?>
                    <?=
                    GridView::widget([
                        'dataProvider' => $dataProvider,
                        'tableOptions' => [
                            'class' => 'table table-striped admin-form table-hover display dataTable no-footer',
                            'id' => 'tbl_category'
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
                            [
                                'class' => 'yii\grid\CheckboxColumn',
                                'checkboxOptions' => [
                                    'style' => 'display:none',
                                    'label' => '<span class="checkbox mn"></span>',
                                    'class' => 'option block mn chk-usr',
                                    'value' => $model->id,
                                ],
                                'header' => '<label for="select-all-users" class="option block mn chk-usrs" data-toggle="tooltip" data-placement="top" title="" data-original-title="Select All Products">
                                              <input id="select-all-users" type="checkbox" name="select-all" class="select-on-check-all">
                                              <span class="checkbox mn"></span>
                                            </label>',
                            ],
                            ['attribute' => 'image',
                                'format' => 'html',
                                'label' => 'Image',
                                'value' => function ($model) {
                                    $image = $model->getDefaultImage($model->id);

                                    if (isset($image[1])) {
                                        $path = 'uploads/images/service/' . $model->id . '/thumbnail/' . $image[1];
                                    } else {
                                        $path = 'img/default.png';
                                    }

                                    return Html::img('/' . $path, ['style' => 'width: 40px !important']);
                                },
                                        'filterInputOptions' => [
                                            'class' => 'form-control',
                                            'placeholder' => 'Search'
                                        ],
                                    ],
                                    [
                                        'attribute' => 'name',
                                    ],
//                            [
//                                'attribute' => 'description',
//                            ],
                                    [
                                        'attribute' => 'short_description',
                                        'format' => 'html',
                                    ],
                                    ['attribute' => 'parent_id',
                                        'value' => function ($model) {
                                            if (isset($model->getParentsByID($model->parent_id)->name)) {
                                                return $model->getParentsByID($model->parent_id)->name;
                                            }
                                        },
                                        'filterInputOptions' => [
                                            'class' => 'form-control',
                                            'placeholder' => 'Search'
                                        ],
                                    ],
                                    [
                                        'attribute' => 'status',
                                        'contentOptions' => function ($model) {
                                            if ($model->status == 0) {
                                                return ['class' => "text-danger"];
                                            } elseif ($model->status == 1) {
                                                return ['class' => "text-success"];
                                            }
                                        },
                                                'value' => function ($model) {
                                            if ($model->status == 0) {
                                                return "Pasive";
                                            } else {
                                                return "Active";
                                            }
                                        },
                                            ],
                                            // 'created_date',
                                            // 'updated_date',
                                            ['class' => 'yii\grid\ActionColumn',
                                                'template' => '{update}{delete}',
                                                'contentOptions' => ['style' => 'width: 20%;'],
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
                                            <?php Pjax::end() ?>
                    <div class="conteiner"></div>
                    <div class="action-block row col-lg-6">
                        <select id="checkbox-actions" class="selectpicker" data-action="service">
                            <option selected class="delete">Delete Items</option>
                        </select>
                        <input type="button" class="btn btn-xs btn-info" value="accept">
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- end: .tray-center -->
</div>

