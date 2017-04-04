<?php

use yii\helpers\Html;
use yii\helpers\Url;
use backend\models\Product;
use common\components\CurrencyHelper;
use backend\models\Currency;
use common\models\Countries;
use common\models\States;
$defaultCurrency = Currency::find()->where(['default'=>1])->one();
$session = Yii::$app->session;

?>
<section id="content">
    <div class="container box single-box order-box">
        <?php if (!empty($basketProducts)): ?>
            <div class="row ordering">
                <div class="col-sm-12">
                    <div class="table-responsive mb50 shop-cart">
                        <table class="table table-hover">
                            <thead>
                            <tr>
                                <th class="span55">PRODUCT</th>
                                <th class="span10">Packages</th>
                                <th class="span20">QUANTITY</th>
                                <th class="span10">AMOUNT</th>
                                <th class="span5"></th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php foreach ($basketProducts as $key => $value): ?>
                                <tr id="bucket-info-<?= $key ?>">
                                    <td class="product">
                                        <?php echo Product::getImagesToFront($value['product']['productID']); ?>
                                        <div class="p_desc">
                                            <h3><?= $value['product']['productName'] ?></h3>
                                            <span>Art.no: <?= $value['art_num']?></span> <span>Stock:
                                                <?php if($value['stock']):?>
                                                    <i>In Stock</i>
                                                <?php else:?>
                                                    <i>Out Stock</i>
                                                <?php endif;?>
                                            </span>
                                        </div>
                                    </td>
                                    <td><span><?= $value['name'] ?></span></td>

                                    <td class="qunatity">

                                        <form action="#" class="shop-quantity">

                                            <button type="button" class="btn btn-b js-qty minus"
                                                    onclick="changeCount(this,<?= $value['packageID'] ?>,<?= $value['product']['productID'] ?>)">
                                                -
                                            </button>
                                            <input type="text" value="<?= $value['count'] ?>"
                                                   class="input-quantity">
                                            <button type="button" class="btn btn-b js-qty plus"
                                                    onclick="changeCount(this,<?= $value['packageID'] ?>,<?= 1?>)">
                                                +
                                            </button>
                                            <span>weight: <i style="color: green"> <?= $value['weight']?></i> gr</span>

                                        </form>

                                    </td>
                                    <td id="order-package-price-<?php echo $key ?>">
                                        <?php if(!empty(Yii::$app->session->get('currency'))):?>
                                            <?php echo CurrencyHelper::changeValue(Yii::$app->session->get('currency')['currenncyID'], $value['totalprice']) ?>
                                        <?php else:?>
                                            <?php echo CurrencyHelper::changeValue($defaultCurrency->id, $value['totalprice']) ?>
                                        <?php endif;?>
                                        $
                                    </td>
                                    <td>
                                        <a href="javascript:void(0)"
                                           onclick="removeBucketProduct(<?php echo $key ?>,<?= $value['product']['productID'] ?>)"
                                           data-toggle="tooltip" title="Remove product"
                                           class="remove-product"><i
                                                class="material-icons">clear</i></a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="clearfix"></div>
                <div class="total-finish">
                    <div class="row">
                        <div class="col-md-8">
                            <div class="discount">
                                <p>Do you have a discount code?</p>
                                <div class="discount-form">
                                    <i class="material-icons">local_offer</i>
                                    <input type="text" id="inputDiscount" class="form-control"
                                           placeholder="Enter your discount code">
                                    <button class="btn">Submit</button>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="finish-price pull-right"><h3>Total Price</h3>
                                    <span class="price" id="bucket-total-price">
                            <?php if(!empty(Yii::$app->session->get('currency'))):?>
                                <?php echo CurrencyHelper::changeValue(Yii::$app->session->get('currency')['currenncyID'], $total) ?>
                            <?php else:?>
                                <?php echo CurrencyHelper::changeValue($defaultCurrency->id, $total) ?>
                            <?php endif;?>
                            </span></div>

                            <div class="finish-price pull-left"><h3>Total Weight</h3>
                                    <span>
                                            <?= $totalWeight?> kg
                            </div>
                            <div class="clearfix"></div>
                        </div>

                    </div>
                </div>
                <div class="container freight">
                    <div class="payment-form col-md-5">
                        <?= $paymentForm; ?>
                    </div>

                    <div class="freight-form col-md-7">
                        <?= $freightForm; ?>
                    </div>

                </div>
                <div class="ship_info">
                    <form action="" id="order-address" class="col-md-6">
                        <div class="ord-col ">
                            <div class="bl_info_box">
                                <h3 class="text-center">Shipping informations</h3>
                                <div class="form-horizontal">
                                    <div class="form-group">
                                        <fieldset class="form-fieldset ui-input">
                                            <input type="text" id="company"
                                                   value="<?php if (!Yii::$app->user->isGuest): ?><?php echo Yii::$app->user->identity->customer->company_name ?><?php endif; ?>"/>
                                            <label for="company">
                                                <span data-text="Company Name">Company Name</span>
                                            </label>
                                        </fieldset>
                                    </div>
                                    <div class="form-group">
                                        <fieldset class="form-fieldset ui-input">
                                            <input type="text" id="name"
                                                   value="<?php if (!Yii::$app->user->isGuest): ?><?php echo Yii::$app->user->identity->customer->name ?><?php endif; ?>"/>
                                            <label for="name">
                                                <span data-text="First Name">First Name</span>
                                            </label>
                                        </fieldset>
                                    </div>
                                    <div class="form-group">
                                        <fieldset class="form-fieldset ui-input">
                                            <input type="text" id="lastname"
                                                   value="<?php if (!Yii::$app->user->isGuest): ?><?php echo Yii::$app->user->identity->customer->surname ?><?php endif; ?>"/>
                                            <label for="lastname">
                                                <span data-text="Last Name">Last Name</span>
                                            </label>
                                        </fieldset>
                                    </div>
                                    <div class="form-group">
                                        <fieldset class="form-fieldset ui-input">
                                            <input type="text" id="address"
                                                   value="<?php if (!Yii::$app->user->isGuest && !empty(Yii::$app->user->identity->customer->customerAddresses)): ?><?php echo Yii::$app->user->identity->customer->customerAddresses[0]->address ?><?php endif; ?>"/>
                                            <label for="address">
                                                <span data-text="Address">Address</span>
                                            </label>
                                        </fieldset>
                                    </div>
                                    <div class="form-group">
                                        <fieldset class="form-fieldset ui-input">
                                            <input type="text" id="postcode"
                                                   value="<?php if (!Yii::$app->user->isGuest && !empty(Yii::$app->user->identity->customer->customerAddresses)): ?><?php echo Yii::$app->user->identity->customer->customerAddresses[0]->zip ?><?php endif; ?>"/>
                                            <label for="postcode">
                                                <span data-text="Zip/Post code">Zip/Post code</span>
                                            </label>
                                        </fieldset>
                                    </div>
                                    <div class="form-group">
                                        <!--                                    <fieldset class="form-fieldset ui-input">-->
                                        <!--                                        <input type="text" id="country"-->
                                        <!--                                               value="--><?php //if (!Yii::$app->user->isGuest && !empty(Yii::$app->user->identity->customer->customerAddresses)): ?><!----><?php //echo Yii::$app->user->identity->customer->customerAddresses[0]->country ?><!----><?php //endif; ?><!--"/>-->
                                        <!--                                        <label for="country">-->
                                        <!--                                            <span data-text="Country">Country</span>-->
                                        <!--                                        </label>-->
                                        <!--                                    </fieldset>-->
                                        <select class="basic" name="">

                                            <?php foreach($countries as $country):?>
                                                <option value="<?=$country['name']?>"><?=$country['name']?></option>
                                            <?php endforeach;?>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <fieldset class="form-fieldset ui-input">
                                            <input type="text" id="city"
                                                   value="<?php if (!Yii::$app->user->isGuest && !empty(Yii::$app->user->identity->customer->customerAddresses)): ?><?php echo Yii::$app->user->identity->customer->customerAddresses[0]->city ?><?php endif; ?>"/>
                                            <label for="city">
                                                <span data-text="City">City</span>
                                            </label>
                                        </fieldset>
                                    </div>
                                    <div class="form-group">
                                        <fieldset class="form-fieldset ui-input">
                                            <input type="text" id="phone"
                                                   value="<?php if (!Yii::$app->user->isGuest): ?><?php echo Yii::$app->user->identity->customer->phone ?><?php endif; ?>"/>
                                            <label for="phone">
                                                <span data-text="Phone">Phone</span>
                                            </label>
                                        </fieldset>
                                    </div>
                                    <div class="form-group">
                                        <fieldset class="form-fieldset ui-input">
                                            <input type="text" id="mobile_phone"
                                                   value="<?php if (!Yii::$app->user->isGuest): ?><?php echo Yii::$app->user->identity->customer->mobile_phone ?><?php endif; ?>"/>
                                            <label for="mobile_phone">
                                                <span data-text="Mobile Phone">Mobile Phone</span>
                                            </label>
                                        </fieldset>
                                    </div>
                                </div>
                                <label class="label--checkbox">
                                    <input type="checkbox" id="del-check" class="checkblock" onclick="turndelivery(this)">
                                    Fill in a separate delivery address
                                </label>
                            </div>
                        </div>
                        <div class="clearfix"></div>
                    </form>


                    <form action="" id="order-delivery" class="col-md-6">
                        <div class="ord-col ">
                            <div class="bl_info_box">
                                <h3 class="text-center">Delivery address</h3>
                                <div class="form-horizontal">

                                    <div class="form-group">
                                        <fieldset class="form-fieldset ui-input">
                                            <input type="text" id="company"/>
                                            <label for="company">
                                                <span data-text="Company Name">Company Name</span>
                                            </label>
                                        </fieldset>
                                    </div>

                                    <div class="form-group">
                                        <fieldset class="form-fieldset ui-input">
                                            <input type="text" id="attn"/>
                                            <label for="attn">
                                                <span data-text="Attn">Attn</span>
                                            </label>
                                        </fieldset>
                                    </div>
                                    <div class="form-group">
                                        <fieldset class="form-fieldset ui-input">
                                            <input type="text" id="address"/>
                                            <label for="address">
                                                <span data-text="Address">Address</span>
                                            </label>
                                        </fieldset>
                                    </div>
                                    <div class="form-group">
                                        <fieldset class="form-fieldset ui-input">
                                            <input type="text" id="postcode"/>
                                            <label for="postcode">
                                                <span data-text="Zip/Post code">Zip/Post code</span>
                                            </label>
                                        </fieldset>
                                    </div>
                                    <div class="form-group">
                                        <fieldset class="form-fieldset ui-input">
                                            <input type="text" id="city"/>
                                            <label for="city">
                                                <span data-text="City">City</span>
                                            </label>
                                        </fieldset>
                                    </div>
                                    <div class="form-group">
                                        <fieldset class="form-fieldset ui-input">
                                            <input type="text" id="country""/>
                                            <label for="country">
                                                <span data-text="Country">Country</span>
                                            </label>
                                        </fieldset>
                                    </div>

                                    <div class="form-group">
                                        <fieldset class="form-fieldset ui-input">
                                            <input type="text" id="phone"/>
                                            <label for="phone">
                                                <span data-text="Phone">Phone</span>
                                            </label>
                                        </fieldset>
                                    </div>
                                    <div class="form-group">
                                        <fieldset class="form-fieldset ui-input">
                                            <input type="text" id="mobile_phone"/>
                                            <label for="mobile_phone">
                                                <span data-text="Mobile Phone">Mobile Phone</span>
                                            </label>
                                        </fieldset>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                    <div class="clearfix"></div>
                </div>
                <div class="col-sm-12 ">
                    <div class="clearfix pd20  ord-footer">
                        <div class="pull-left">
                            <a href="<?php echo Url::to(['product/index']) ?>" class="btn btn-big btn-ship btn-back">
                                <i class="material-icons">reply</i> Back To Products<i></i></a>
                        </div>
                        <div class="pull-right">
                            <button type="submit" class="btn btn-default order-continue"
                                    id="order_step_2">Confirm
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        <?php else:?>
            <div class="row">
                <div class="checkout_empty">
                    <h2><div></div>
                        Your Cart is Empty
                    </h2>
                    <br>
                    <div class="text-center"><a href="/en/product/index" class="btn btn-big btn-ship btn-back""><i
                            class="material-icons">reply</i> Back To Products<i></i></a></div>
                </div>
            </div>
        <?php endif; ?>

    </div>
    </div>
</section>


