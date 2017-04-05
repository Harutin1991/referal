<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\TrBlog */

$this->title = Yii::t('app', 'Create Tr Blog');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Tr Blogs'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tr-blog-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
