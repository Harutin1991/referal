<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\Service */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Services'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="service-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Back to Services'), ['index',], ['class' => 'btn btn-sm btn-info']) ?>
        <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-sm btn-danger',
            'data' => [
                'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>
    <div class="panel">
        <div class="panel-body">

            <?= DetailView::widget([
                'model' => $model,
                'attributes' => [
//                    'id',
                    'name',
                    'description:html',
                    'short_description:html',
                    [
                        'attribute' => 'status',
                        'value' => ($model->status == 0) ? 'Pasive' : 'Active'
                    ],
//                    'created_date',
//                    'updated_date',
                ],
            ]) ?>
        </div>
    </div>
</div>
