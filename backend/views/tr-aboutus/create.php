<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\TrAboutus */

$this->title = Yii::t('app', 'Create Tr Aboutus');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Tr Aboutuses'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tr-aboutus-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
