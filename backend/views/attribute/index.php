<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use kartik\select2\Select2;
use backend\models\Category;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\AttributeSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Attributes');
$this->params['breadcrumbs'][] = Yii::t('app', $this->title);

$categories_model = new Category();
$categories = $categories_model->getAllCategories();
?>
<div class="table-layout">
    <div class="tray tray-center filter">
        
        <div id="attr-form_cont">
            <?= Html::a(Yii::t('app','<span class="fa fa-plus pr5"></span> Create Attribute'), ['/attribute/create'], ['class'=>'btn btn-system mb15']) ?>
        </div>
        
        <!-- recent orders table -->
        <div class="panel">
            <div class="panel-body pn">
                <div class="table-responsive">
                    <?php Pjax::begin(['id' => 'attrPjaxtbl']) ?>
                    <?= GridView::widget([
                        'dataProvider' => $dataProvider,
//                        'filterModel' => $searchModel,
                        'tableOptions' => [
                            'class' => 'table table-striped admin-form table-hover display dataTable no-footer',
                            'id' => 'tbl_attr'
                        ],
                        'filterRowOptions' => [
                            'role' => "row",
                        ],
                        'rowOptions' => [
                            'role' => "row",
                            'class' => 'odd'
                        ],
                        'summary' => false,
                        'options' => ['class' => 'br-r', 'id' => 'product'],
                        'columns' => [
                            [
                                'class' => 'yii\grid\CheckboxColumn',
                                'checkboxOptions' => [
                                    'style' => 'display:none',
                                    'label' => '<span class="checkbox mn"></span>',
                                    'class' => 'option block mn chk-usr',
                                    'value' => $model->id
                                ],
                                'header' => '<label for="select-all-users" class="option block mn chk-usrs" data-toggle="tooltip" data-placement="top" title="" data-original-title="Select All Products">
                                              <input id="select-all-users" type="checkbox" name="select-all" class="select-on-check-all">
                                              <span class="checkbox mn"></span>
                                            </label>',
                            ],
                            ['attribute' => 'name',
                                'filterInputOptions' => [
                                    'class' => 'form-control',
                                    'placeholder' => 'Search'
                                ],
                            ],
//                            ['attribute' => 'value',
//                                'filterInputOptions' => [
//                                    'class' => 'form-control',
//                                    'placeholder' => 'Search'
//                                ],
//                            ],
//            'created_date',
//            'updated_date',
                            ['attribute' => 'category',
                                'value' => function ($model) {
                                if(isset($model->category->name)){
                                    return $model->category->name;
                                }
                                },
                                'filterInputOptions' => [
                                    'class' => 'form-control',
                                    'placeholder' => 'Search'
                                ],
                            ],

                            ['class' => 'yii\grid\ActionColumn',
                                'template' => '{delete}{update}',
                                'buttons' =>[
                                    'update' => function ($url, $model) {
                                        return Html::a('<span class="glyphicon glyphicon-pencil"></span> Edit',
                                            $url,
                                            [
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
                                        return Html::a('<span class="glyphicon glyphicon-trash"></span> Delete',
                                            $url,
                                            [
                                                'title' => Yii::t('app', 'Delete'),
                                                'aria-label' => Yii::t('app', 'Delete'),
                                                'data-confirm' =>Yii::t('app', 'Are you sure! You whant delete this item?'),
                                                'data-method' =>'post',
                                                'data-pjax' => '0',
                                                'data-key' => $model->id,
                                                'class' => 'btn btn-danger btn-xs fs12 br2 ml5 pull-right'
                                            ]);
                                    },
                                ]
                            ],
                        ],
                    ]); ?>
                    <?php Pjax::end() ?>
                    <div class="conteiner"></div>
                    <div class="action-block row col-lg-6">
                        <select id="checkbox-actions" data-action="attribute">
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

            <h4><?php echo Yii::t('app', 'Filter Repaier')?></h4>

            <hr class="short">
            <?php echo $this->render('_search', ['model' => $searchModel,'categories'=>$categories]); ?>
        </div>
    </aside>
    <!-- end: .tray-right -->


    <!-- end: .tray-center -->
</div>