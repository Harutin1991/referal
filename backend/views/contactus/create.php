<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\Contactus */

$this->title = Yii::t('app', 'Create Contactus');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Contactuses'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="contactus-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
