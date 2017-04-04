<?php

use yii\helpers\Url;
use yii\helpers\Html;
use common\components\CurrencyHelper;
use yii\data\ArrayDataProvider;
use backend\models\Partners;
use backend\models\Files;
use backend\models\Service;
use backend\models\Slider;
use backend\models\Sitesettings;
use backend\models\Aboutus;
use frontend\models\Product;

/* @var $this yii\web\View */
//$partners = Partners::findList();
$filter = ['parent_id' => NULL];
$services = Service::findList(2, $filter);
$filter = ['in_slider' => 1];
$sliders = Product::findList($filter);
$filter = ['best_seller' => 1,'limit'=>1];
$bestSeller = Product::findList($filter);
$servicesList = Service::findList(12);
$aboutus = Aboutus::find_One();
$aboutfile = Files::find()->where(['category' => 'about', 'category_id' => $aboutus[0]['aboutus_id'], 'status' => 1, 'top' => 1])->asArray()->all();

$this->title = Yii::t('app', 'Home');

?>

<div class="product-sort hidden-xs hidden-sm col-md-12 col-lg-12">
    <div class="container">
        <?php foreach ($servicesList as $list): ?>
            <div class="col-xs-12 col-sm-2 col-md-2 col-lg-2">
                <div class="box">
                    <a href="/<?= Yii::$app->language ?>/page/service/<?= $list['route_name'] ?>"><?= $list['name'] ?></a>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>
<div class="carousel-wrapper col-xs-12">
    <div class="container">
        <div class="hidden-xs hidden-sm col-md-8 col-lg-8">
            <div class="left-sidebar">
                <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
                    <ol class="carousel-indicators">
                    <?php $count = 0; foreach ($sliders as  $slider): ?>
                        <li data-target="#carousel-example-generic" data-slide-to="<?= $count ?>" <?php if(!$count):?>class="active"<?php endif;?> ></li>
                    <?php $count++; endforeach; ?>
                        </ol>
                    <div class="carousel-inner" role="listbox">
                        <?php $count = 0; foreach ($sliders as $slider): ?>
                        <div class="item <?php if(!$count):?>active<?php endif;?>">
                            <?php echo Html::img(Yii::$app->params['adminUrl'] . 'uploads/images/product/' . $slider['id'] . '/' . $slider['image'], ['class' => 'img-responsive']); ?>
                            <div class="carousel-caption">
                                <div class="title"><?=$slider['name']?></div>
                                <div class="txt"><?=$slider['short_description']?></div>
                            </div>
                        </div>
                        <?php $count++; endforeach;?>
                    </div>
                </div>
            </div>
        </div>
        <div class="right-sidebar col-xs-12 col-sm-12 col-md-4 col-lg-4">
            <div class="reclame-wrapper">
                <?php echo Html::img(Yii::$app->params['adminUrl'] . 'uploads/images/product/' . $bestSeller[0]['id'] . '/' . $bestSeller[0]['image'], ['class' => 'img-responsive']); ?>
                <a href="/product/best-seller"><?=Yii::t('app','ALL SALES')?></a>
            </div>
        </div>
    </div>
</div>
<div class="container">
    <div class="about-wrapper col-xs-12" style="background-image: url(<?php echo Yii::$app->params['adminUrl'] . 'uploads/images/about/' . $aboutus[0]['aboutus_id'] . '/' . $aboutfile[0]['path']?>);">
        <div class="layer"></div>
        <div class="title"><?=$aboutus[0]['title']?></div>
        <div class="txt"><?=$aboutus[0]['short_description']?></div>
    </div>
    <div class="service-wrapper col-xs-12">
        <div class="paragraph"><?=Yii::t('app','OUR SERVICES');?></div>
        <?php foreach($services as $key=>$service):?>
        <div class="<?php if(!$key && !$key%2): ?>title-boxes-first<?php else:?>title-boxes-secound<?php endif;?>">
            <span><?=$service['name']?></span>
        </div>
        <div class="regular slider container-fluid">
            <?php $childServices = Service::find()->where(['parent_id'=>$service['service_id']])->asArray()->all();
                foreach($childServices as $child){
            ?>
            <div class="slick-slider-m">
                <div class="box col-xs-12">
                    <div class="fild">
                        <div class="left-bar col-xs-12 col-sm-6 col-md-6 col-lg-6">
                            <div class="title">
                                <i class="fa fa-cog" aria-hidden="true"></i>
                                <span><?=$child['name']?></span>
                            </div>
                            <div class="txt"><?=$child['short_description']?></div>
                            <div class="see-more">
                                <a href="page/service/<?=$child['route_name']?>"><?=Yii::t('app','VIEW ALL')?></a>
                            </div>
                        </div>
                        <div class="right-bar col-xs-12 col-sm-6 col-md-6 col-lg-6">
                            <?php $model = new Service(); $image = $model->getDefaultImage($child['id']);
                            ?>
                            <div style="background-image: url(<?php if(isset($image[1])){ echo Yii::$app->params['adminUrl'] . 'uploads/images/service/' . $child['id'] . '/' . $image[1];} ?>);" class="bg-img">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
                <?php }?>
        </div>
        <?php endforeach;?>
    </div>
</div>
<?php
$this->registerJs('
    $(document).ready(function(){
		    if($(window).width() < 5000 & $(window).width() > 991){
		        $(".regular").slick({
		            dots: true,
		            infinite: true,
		            slidesToShow: 2,
		            slidesToScroll: 1
		        });
		    }else if ($(window).width() > 767) {
		        $(".regular").slick({
		            dots: true,
		            infinite: true,
		            slidesToShow: 1,
		            slidesToScroll: 1
		        });
		    }else if($(window).width() > 425) {
		    $(".regular").slick({
		        dots: true,
		        infinite: true,
		        slidesToShow: 1,
		        slidesToScroll: 1
		      });
		    }else{
		    $(".regular").slick({
		        dots: true,
		        infinite: true,
		        slidesToShow: 1,
		        slidesToScroll: 1
		      });
		    }
		});
');
?>