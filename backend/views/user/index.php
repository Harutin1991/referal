<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\admin\search\UserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Users');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-index">

    <h1><?=Yii::t('app', 'Settings')?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Change Password'), ['change_password'], ['class' => 'btn btn-success']) ?>
        <?= Html::a(Yii::t('app', 'Change Login'), ['change_username'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,

        'columns' => [
//            'id',
            'username',
            'email',
            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{update}',

            ],
        ],
    ]); ?>
</div>
