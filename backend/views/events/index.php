<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\EventsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Events');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="table-layout">
    <div class="tray tray-center">
        <!-- create new order panel -->
        <div id="product-form_cont">

            <?= Html::a(Yii::t('app', '<span class="fa fa-plus pr5"></span>Create Event'), ['/events/create'], ['class' => 'btn btn-system mb15']) ?>
        </div>
        <!-- recent orders table -->
        <div class="panel">
            <div class="panel-body pn">
                <div class="table table-responsive">
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
                            [
                                'class' => 'yii\grid\CheckboxColumn',
                                'checkboxOptions' => [
                                    'style' => 'display:none',
                                    'label' => '<span class="checkbox mn"></span>',
                                    'class' => 'option block mn chk-usr',
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
                                        $path = 'uploads/images/events/'.$model->id.'/thumbnail/' . $image[1];
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
                            ['attribute' => 'short_description',
                                'format' => 'html',
                                'filterInputOptions' => [
                                    'class' => 'form-control',
                                    'placeholder' => 'Search'
                                ],
                            ],
                            ['attribute' => 'status',
                                'contentOptions' => function ($model) {
                                    if ($model->status == 0) {
                                        return ['class' => "list-status label label-rounded label-info"];
                                    } elseif ($model->status == 1) {
                                        return ['class' => "list-status label label-rounded label-success"];
                                    }
                                },
                                'value' => function ($model) {
                                    if ($model->status == 0) {
                                        return "Unavailable";
                                    } elseif ($model->status == 1) {
                                        return "Available";
                                    }
                                },
                                'filter' => Html::activeDropDownList($searchModel, 'status', ["Unavailable", "Available"], ['class' => 'form-control prod-search-status', 'prompt' => 'Select Status', 'style' => 'width:130px']),
                                'filterInputOptions' => [
                                    'class' => 'form-control',
                                    'prompt' => 'Search'
                                ],
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
                    <div class="conteiner"></div>

                    <div class="action-block row col-lg-6">
                        <select id="checkbox-actions" data-action="product" data-style="btn-primary">
                            <option class="low-stock">Low stock</option>
                            <option class="out-of-stock">Out of stock</option>
                            <option class="in_slider">add in slider</option>
                            <option class="activating">activating</option>
                            <option class="disactivating">disactivating</option>
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

            <h4> Filter Products</h4>

            <hr class="short">
<?php echo $this->render('_search', ['model' => $searchModel]); ?>
        </div>
    </aside>
    <!-- end: .tray-right -->


    <!-- end: .tray-center -->
</div>
