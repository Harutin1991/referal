<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\ZonesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Zones');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="zones-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Create Zones'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            'name',
            'type',
            'description:ntext',
            ['class' => 'yii\grid\ActionColumn',
                'template' => '{edit}{delete}{update}',
                'buttons' => [

                    'delete' => function ($url, $model) {


                            return Html::a('<span class="glyphicon glyphicon-trash"></span> Delete',
                                $url,
                                [
                                    'title' => 'Delete',
                                    'aria-label' => 'Delete',
                                    'data-confirm' =>'Are you sure! You whant delete this item?',
                                    'data-method' =>'post',
                                    'data-pjax' => '0',
                                    'data-key' => $model->id,
                                    'class' => 'btn btn-danger btn-xs fs12 br2 ml5 pull-right'
                                ]);

                    },
                    'update' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-trash"></span> Edit',
                            $url,
                            [
                                'title' => 'Edit',
                                'aria-label' => 'Edit',
                                //'data-confirm' =>'Are you sure! You whant delete this item?',
                                //'data-method' =>'post',
                                //'data-pjax' => '0',
                                'data-key' => $model->id,
                                'class' => 'btn btn-info btn-xs fs12 br2 ml5 pull-right'
                            ]);
                    },
                ]
            ],


        ],
    ]); ?>
</div>
