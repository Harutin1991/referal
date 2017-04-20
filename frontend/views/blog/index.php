<?php

use yii\widgets\LinkPager;
use yii\helpers\Url;
use yii\web\View;
use backend\models\Files;

$this->registerCssFile("@web/css/mansory/component.css", [
    'depends' => [frontend\assets\AppAsset::className()]]);
$this->registerJsFile(
        '@web/js/mansory/modernizr.custom.js', ['depends' => [\yii\web\JqueryAsset::className()]]
);
$this->title = Yii::t('app','Blog');
?>
<div class="blog-page col-xs-12">
    <div class="container-fluid">
        <ul class="grid effect-1" id="grid">
            <?php foreach ($blogs as $key => $blog): ?>
                <li>
                    <div class="blog-all">
                        <?php echo Files::getImagesToFront('blog', $blog['blog_id'], 'img-responsive', $blog['title'], 1) ?>
                        <div class="text-container">
                            <a href="/<?= Yii::$app->language ?>/blog/<?= $blog['blog_id'] ?>" class="view-blog"><?= $blog['title'] ?></a>
                        </div>
                    </div>
                </li>
            <?php endforeach; ?>
        </ul>
    </div>
</div>
<?php
$this->registerJsFile(
        '@web/js/mansory/masonry.pkgd.min.js', ['depends' => [\yii\web\JqueryAsset::className()]]
);
$this->registerJsFile(
        '@web/js/mansory/imagesloaded.js', ['depends' => [\yii\web\JqueryAsset::className()]]
);
$this->registerJsFile(
        '@web/js/mansory/classie.js', ['depends' => [\yii\web\JqueryAsset::className()]]
);
$this->registerJsFile(
        '@web/js/mansory/AnimOnScroll.js', ['depends' => [\yii\web\JqueryAsset::className()]]
);
$this->registerJsFile(
        '@web/js/mansory/index.js', ['depends' => [\yii\web\JqueryAsset::className()]]
);
?>