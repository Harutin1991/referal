<?php

use yii\widgets\LinkPager;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $products frontend\models\Product[] */

?>
<div class="row products">
    <?php if(empty($products)) : ?>
        <div class="col-md-12 col-sm-12">
            <div class="col-md-offset-3 col-md-6">
                <h3 class="text-center">You have not any <u>favorite</u> product!</h3>
            </div>
        </div>
    <?php else: ?>
    <?php foreach ($products as $key => $product): ?>
        <!--        <pre>-->
        <!--            --><?php //var_dump($product); die;?>
        <?php if (!$isDefaultLanguage): ?>
            <div class="col-md-12" id="<?= 'fvrt_'.$key;?>">
                <div class="product_list_item box">
                    <div class="product_top_nav pop_line">
                        <div class="col-md-12">
                            <div class="pull-right prod-top-nav">
                                <i class="material-icons product_share">share</i>
                                <a href="javascript:void(0)" class="product_subscribe" data-toggle="tooltip"
                                   title="subscribe"><i class="fa fa-paper-plane"></i></a>

                                <a class="add-favorite" data-toggle="tooltip" title="remove from favorite"
                                   href="javascript:void(0)">

                                    <button id="<?php echo "heart_".$key ?>" onclick="favorite(<?php echo $key ?>)" class="faved">
                                            <span class="glyphicon glyphicon-heart">
                                    <span class="glyphicon glyphicon-heart">
                                    </span>
                                  </span>
                                    </button>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 pd0">
                        <div class="col-md-4 col-sm-4">
                            <div class="row">
                                <div class="product_list_thumb">
                                    <a href="<?php echo Url::to(['product/index', 'id' => $key]) ?>"> <?php echo backend\models\Product::getImagesToFront($key) ?></a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-5 col-sm-5">
                            <div class="row">
                                <div class="title_list_box">
                                    <h2 class="product_title"><a
                                            href="<?php echo Url::to('product/index/' . $key) ?>"><?php echo $product['name'] ?></a>
                                    </h2>
                                </div>
                                <div class="prod_desc hidden-xs">
                                            <span>
                                                <?php echo $product->product->short_description ?>
                                            </span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 pd0">
                        <div class="col-md-8 col-sm-8">
                            <div class="row list_shop_by">
                                <?php foreach ($product['package'] as $item => $package) : ?>
                                    <div class="col-md-12 col-sm-12 col-xs-12 pd0">
                                        <div class="shopping_by"><?php echo $package['titele'] ?><span
                                                class="price"><?php echo $package['price'] ?></span></div>
                                        <form action="#" class="shop-quantity product-quant">
                                            <button type="button" class="btn btn-b js-qty minus"
                                                    onclick="changeCount(this)"> -
                                            </button>
                                            <input type="text" value="1" class="input-quantity"
                                                   id="input-number-<?php echo $item ?>">
                                            <button type="button" class="btn btn-b js-qty plus"
                                                    onclick="changeCount(this)"> +
                                            </button>
                                        </form>

                                            <button class="btn btn-big item_add" id="item_buy"
                                                    onclick="buyProduct(<?= $key ?>,<?= $item ?>)"><i
                                                    class="material-icons">shopping_cart</i> ADD TO CARD
                                            </button>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        <?php else: ?>
            <div class="col-md-12">
                <div class="product_list_item box">
                    <div class="product_top_nav pop_line">
                        <div class="col-md-12">
                            <div class="pull-right prod-top-nav">
                                <i class="material-icons product_share">share</i>

                                <a href="javascript:void(0)" class="product_subscribe" data-toggle="tooltip"
                                   title="subscribe"><i class="fa fa-paper-plane"></i></a>

                                <a class="add-favorite" data-toggle="tooltip"
                                   title="remove from favorite"
                                   href="javascript:void(0)">
                                    <button id="heart"
                                            onclick="favorite(<?php echo $model->id ?>)" class="faved">
                                     <span class="glyphicon glyphicon-heart">
                                    <span class="glyphicon glyphicon-heart">
                                    </span>
                                  </span>
                                    </button>
                                </a>
                                <a class="product-print" data-toggle="tooltip" title="print page"
                                   href="javascript:window.print()"><i class="material-icons">print</i></a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 pd0">

                        <div class="col-lg-4 col-md-3 col-sm-3">
                            <div class="row">
                                <div class="product_list_thumb">
                                    <a href="<?php echo Url::to(['product/index', 'id' => $key]) ?>"> <?php echo backend\models\Product::getImagesToFront($key) ?></a>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-4">
                            <div class="row">
                                <div class="title_list_box">
                                    <h2 class="product_title"><a
                                            href="<?php echo Url::to('product/index/' . $key) ?>"><?php echo $product['name']; ?></a>
                                    </h2>
                                </div>
                                <div class="prod_desc hidden-xs">
                                            <span>
                                                <?php //echo $value->short_description ?>
                                            </span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 pd0">
                        <div class="col-md-12 col-sm-12">
                            <div class="row list_shop_by">
                                <?php foreach ($product['package'] as $item => $package) : ?>
                                    <div class="price_package col-md-12 col-sm-12 col-xs-12 pd0">
                                        <div class="shopping_by"><?php echo $package['titele'] ?><span
                                                class="price"><?php echo $package['price'] ?></span></div>
                                        <form action="#" class="shop-quantity product-quant">
                                            <button type="button" class="btn btn-b js-qty minus"
                                                    onclick="changeCount(this)"> -
                                            </button>
                                            <input type="text" value="1" class="input-quantity"
                                                   id="input-number-<?php echo $item ?>">
                                            <button type="button" class="btn btn-b js-qty plus"
                                                    onclick="changeCount(this)"> +
                                            </button>
                                        </form>
                                            <button class="btn btn-big item_add" id="item_buy"
                                                    onclick="buyProduct(<?= $key ?>,<?= $item ?>)"><i
                                                    class="material-icons">shopping_cart</i> ADD TO CARD
                                            </button>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                    <div class="col-md-8 col-sm-8">
                    </div>
                </div>
            </div>
        <?php endif; ?>
    <?php endforeach; ?>
    <?php endif; ?>
</div>
