<?php
use yii\helpers\Url;
use yii\helpers\Html;
use common\components\CurrencyHelper;
?>

<div class="container box best_sellers">
    <h3 class="text-center"><?= Yii::t('app','BEST SELLERS');?></h3>
    <div class="best_items">
<?php foreach ($products as $value){ ?>
        <div class="col-md-4 pd0">
            <div class="best_item">
                <div class="col-md-5  pd0">
                    <a href="<?php echo Url::to(['product/view', 'id' => $value['id']]) ?>"> <?php echo  Html::img(Yii::$app->params['adminUrl'].'/uploads/images/' . $value['image']); ?></a>
                </div>
                <div class="col-md-7">
                    <h4><?= $value['name'] ?></h4>
                    <span><?= $value['short_description'] ?></span>
                    <?php foreach ($value['package']  as $k => $pack){ ?>
                    <div class="best product-package">
                        <ul>
                            <li>
                                <div class="shopping_by">
                                    <span>
                                    <?php echo CurrencyHelper::changeValueWithPrice( $pack['price'],$currency_details->exchange_value).''.$currency_details->short_code; ?>

                                    </span>
                                    <i class="fa fa-cube
                                <? echo $k == 0 ?'' : 's'?>" aria-hidden="true"></i> <?= $pack['title'] ?>
                                </div>
                                <form action="#" class="shop-quantity">
                                    <button type="button" class="btn btn-b js-qty minus"
                                            onclick="changeCount(this)"> -
                                    </button>
                                    <input type="text" value="1" id="input-number-bestseller-<?php echo $k; ?>"
                                           class="input-quantity">

                                    <button type="button" class="btn btn-b js-qty plus"
                                            onclick="changeCount(this)"> +
                                    </button>
                                </form>
                                <div class="order_by" data-product-id="<?php echo $value['id'] ?>" data-package-id="<?php echo $k ?>" data-product-status="bestseller">
                                    <i class="material-icons add-to-cart" data-toggle="tooltip"
                                       title="Add To Cart">shopping_cart</i>
                                </div>
                            </li>
                        </ul>
                    </div>
                    <?php } ?>
                </div>
                <div class="clearfix"></div>
            </div>
        </div>
        <?php } ?>

    </div>
</div>
