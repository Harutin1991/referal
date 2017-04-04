<?php

use yii\helpers\Html;
use yii\data\ArrayDataProvider;
use frontend\models\Category;
use backend\models\Files;
$currentUrl = trim(substr($_SERVER['REQUEST_URI'], 3));

?>
<div class="product-page col-xs-12">
    <div class="container">
        <?php foreach ($products as $product): ?>
        <div class="boxes col-xs-12 col-sm-6 col-md-4 col-lg-4">
            <figure class="box">
                <?php echo Html::img(Yii::$app->params['adminUrl'] . 'uploads/images/product/' . $product['id'] . '/' . $product['image'],['class'=>'img-responsive','style'=>'margin: 0 auto;']); ?>
                <figcaption><?= $product['name'] ?></figcaption>
                <a href="/<?= Yii::$app->language ?>/product/<?= $product['route_name'] ?>"></a>
            </figure>
        </div>
        <?php endforeach; ?>
    </div>
</div>

<?php
echo \yii\widgets\LinkPager::widget([
    'pagination' => $provider->pagination,
]);
?>
