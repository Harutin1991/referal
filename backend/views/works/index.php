<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\WorksSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Works');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="table-layout">
    <div class="tray tray-center filter">
        <!-- create new order panel -->
        <div id="category-form_cont">
            <?= Html::a(Yii::t('app','<span class="fa fa-plus pr5"></span> Create New Work'), ['/works/create'], ['class'=>'btn btn-system mb15']) ?>
        </div>
        <!-- recent orders table -->
        <div class="panel">
            <div class="panel-body pn">
<div class="table-responsive">
                    <?= GridView::widget([
                        'dataProvider' => $dataProvider,
                        'tableOptions' => [
                            'class' => 'table table-striped admin-form table-hover display dataTable no-footer',
                            'id' => 'tbl_work'
                        ],
                        'filterRowOptions' => [
                            'role' => "row"
                        ],
                        'rowOptions' => [
                            'role' => "row",
                            'class' => 'odd ui-state-default'
							'data-id'=>$model->id
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
//            ['class' => 'yii\grid\SerialColumn'],

//            'id',
                            ['attribute' => 'name',
                                'filterInputOptions' => [
                                    'class' => 'form-control',
                                    'placeholder' => 'Search'
                                ],
                            ],
                            ['attribute' => 'short_description',
                                'format'=>'html',
                                'filterInputOptions' => [
                                    'class' => 'form-control',
                                    'placeholder' => 'Search'
                                ],
                            ],
                            ['attribute' => 'status',
                                'value' => function ($model) {
                                    if ($model->status) {
                                        return "Yes";
                                    } else {
                                        return 'No';
                                    }
                                },
                                'filterInputOptions' => [
                                    'class' => 'form-control',
                                    'placeholder' => 'Search'
                                ],
                            ],
                            ['attribute' => 'url',
                                'filterInputOptions' => [
                                    'class' => 'form-control',
                                    'placeholder' => 'Search'
                                ],
                            ],
                            // 'created_date',
                            // 'updated_date',

                            ['class' => 'yii\grid\ActionColumn',
                                'template' => '{update}{delete}',
                                'contentOptions' => ['style' => 'width: 20%;'],
                                'buttons' => [
                                    'delete' => function ($url, $model) {
                                        return Html::a('<span class="glyphicon glyphicon-trash"></span> Delete',
                                            $url,
                                            [
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
                                        return Html::a('<span class="glyphicon glyphicon-pencil"></span> Edit',
                                            $url,
                                            [
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
                    ]); ?>
                    <div class="conteiner"></div>
                    <div class="action-block row col-lg-6">
                        <select id="checkbox-actions" class="selectpicker" data-action="works">
                            <option selected class="delete">Delete Items</option>
                        </select>
                        <input type="button" class="btn btn-xs btn-info" value="accept">
                    </div>

                </div>
            </div>
        </div>
    </div>
    <!-- begin: .tray-right -->
    <aside class="tray tray-right tray290 filter">
        <!-- menu quick links -->
        <div class="admin-form mw250">

            <h4> Filter Repaier</h4>

            <hr class="short">
            <?php echo $this->render('_search', ['model' => $searchModel]); ?>
        </div>
    </aside>
    <!-- end: .tray-right -->


    <!-- end: .tray-center -->
</div>


