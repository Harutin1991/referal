<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\User */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Users'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'username',
            'first_name',
            'last_name',
            'email:email',
            'password',
            'role',
            'bio:ntext',
            'gender',
            'dob',
            'pic',
            'country',
            'state',
            'city',
            'address',
            'phone',
            'mobile_phone',
            'postal',
            'starting_amount',
            'purse',
            'referal_link',
            'invitation_users_count',
            'auth_key',
            'remember_token',
            'password_token',
            'api_key',
            'social_type',
            'social_id',
            'social_user_name',
            'status',
            'activity_status',
            'referal_link_created',
            'deleted_at',
            'created',
            'updated',
        ],
    ]) ?>

</div>
