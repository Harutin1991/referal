<?php  if ($session->has('basket') && !empty($session->get('basket')['product'])): ?>
    <div class="container">
        <div class="shopping-cart">
            <ul class="shopping-cart-items" id="basket_section">
                <?php foreach($session->get('basket')['product'] as $key=>$value): ?>
                    <?php if (!$isDefaultLanguage): ?>
                        <?php if(isset($value['info']->id)):?>
                            <li class="clearfix">
                                <?php echo backend\models\Product::getImagesToFront($value['info']->id) ?>
                                <span class="item-name"><?= $value['info']->product->name ?></span>
                                <span class="item-price price"><?= $value['info']->product->price ?></span>
                                <form action="#" class="shop-quantity basket_quant">
                                    <button type="button" class="btn btn-b js-qty minus" onclick="changeCount(this)"> - </button>
                                    <input type="text" value="<?= $value['count'] ?>" id="input-number-32" class="input-quantity">
                                    <button type="button" class="btn btn-b js-qty plus" onclick="changeCount(this)"> + </button>
                                </form>
                                <a href="javascript:void(0)"
                                   onclick="removeBucketProduct(<?php echo $key ?>)"
                                   data-toggle="tooltip" data-placement="left" title="Remove product"
                                   class="remove-product"><i
                                        class="material-icons">clear</i></a>
                            </li>
                        <?php endif;?>
                    <?php else: ?>
                        <?php if(isset($value['info']->id)):?>
                            <li class="clearfix">
                                <?php echo backend\models\Product::getImagesToFront($value['info']->id) ?>
                                <span class="item-name"><?= $value['info']->name ?></span>
                                <span class="item-price price"><?= $value['info']->price ?></span>
                                <form action="#" class="shop-quantity basket_quant">
                                    <button type="button" class="btn btn-b js-qty minus" onclick="changeCount(this)"> - </button>
                                    <input type="text" value="<?= $value['count'] ?>" id="input-number-32" class="input-quantity">
                                    <button type="button" class="btn btn-b js-qty plus" onclick="changeCount(this)"> + </button>
                                </form>
                                <a href="javascript:void(0)"
                                   onclick="removeBucketProduct(<?php echo $key ?>)"
                                   data-toggle="tooltip" data-placement="left" title="Remove product"
                                   class="remove-product"><i
                                        class="material-icons">clear</i></a>
                            </li>
                        <?php endif; ?>
                    <?php endif; ?>

                <?php endforeach;?>

            </ul>
            <div class="shopping-cart-total">
                <span class="lighter-text">Total:</span><span class="main-color-text" id="basket-product-prices">$<?php echo $session->get('basketPrice')?></span>
            </div>

            <a href="<?php echo Url::to('/cart/list')?>" class="button">PROCCED TO CHECKOUT</a>
        </div> <!--end shopping-cart -->

    </div>
<?php endif;?>