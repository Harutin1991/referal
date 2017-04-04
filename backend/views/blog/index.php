<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use common\components\TimeFormaterHelper;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\BlogSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Blogs');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="row">
    <div class="col-md-12">
        <div class="blog-index">

            <h1><?= Html::encode($this->title) ?></h1>

            <div class="tray tray-center filter">
                <div id="product-form_cont">
                    <?= Html::a(Yii::t('app', '<i class="fa fa-plus fa-plus-square pr5"></i>Create New Blog'), ['/blog/create'], ['class' => 'btn btn-responsive button-alignment btn-success mb15']) ?>
                </div>
                <div class="panel">
                    <div class="panel-body pn">
                        <div class="table-responsive">
                            <?php Pjax::begin(['id' => 'blogPjaxtbl']) ?>
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
                                        'attribute' => 'short_description',
                                    ],
                                    [
                                        'attribute' => 'status',
                                        'contentOptions' => function ($model) {
                                            if ($model->status == 0) {
                                                return ['class' => "label list-status label-rounded label-danger"];
                                            } elseif ($model->status == 1) {
                                                return ['class' => "label list-status label-rounded label-system"];
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
                                    [
                                        'attribute' => 'created_at',
                                        'value' => function($model) {
                                            return TimeFormaterHelper::convert($model->created_at);
                                        }
                                    ],
                                    ['class' => 'yii\grid\ActionColumn',
                                        'template' => '{edit}{delete}',
                                        'buttons' => [
                                            'edit' => function ($url, $model) {
                                                $title = '';
                                                $btn_class = "";
                                                $data_pjax = '';
                                                if ($model['status'] == 0) {
                                                    $data_pjax = json_encode(['id' => $model['id'], 'status' => 1]);
                                                    $title = "Enable";
                                                    $btn_class = "btn-success";
                                                } elseif ($model['status'] == 1) {
                                                    $data_pjax = json_encode(['id' => $model['id'], 'status' => 0]);
                                                    $title = "Disable";
                                                    $btn_class = "btn-danger";
                                                }
                                                $link = Html::button($title, ['title' => Yii::t('yii', $title),
                                                            'class' => 'btn ' . $btn_class . ' br2 btn-xs fs12 blog_change_status',
                                                            'data-pjax' => $data_pjax
                                                ]);
                                                return $link;
                                            },
                                            'delete' => function ($url, $model) {
                                                return Html::a('<span class="glyphicon glyphicon-trash" style="color: #666666"></span>', $url, [
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
                            <?php Pjax::end() ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php echo $this->registerJs("
            CKEDITOR.replace('blog-description', {
                height: 210,
                on: {
                    instanceReady: function(evt) {
                        $('.cke').addClass('admin-skin cke-hide-bottom');
                    }
                },
            });
"); ?>
