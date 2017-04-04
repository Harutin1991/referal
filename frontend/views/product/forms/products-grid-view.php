<?php

use yii\helpers\Url;
use yii\helpers\Html;
use common\components\CurrencyHelper;
?>
<?php foreach ($products as $product): ?>
    <div class="box col-xs-12 col-sm-6 col-md-4 col-lg-4">
        <a href="/<?= $product['route_name'] ?>">
    <?php echo Html::img(Yii::$app->params['adminUrl'] . 'uploads/images/product/' . $product['id'] . '/thumbnail/' . $product['image']); ?>
            <div class="title"><?= $product['name'] ?></div>
        </a>
    </div>
<?php endforeach; ?>

<?php
echo \yii\widgets\LinkPager::widget([
    'pagination' => $provider->pagination,
]);
?>
