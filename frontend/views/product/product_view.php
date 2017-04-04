<?php
/* @var $this yii\web\View */
/* @var $model frontend\models\Product */
?>

<section id="content">

    <div class="container box single-box">
        <div class="row">
            <div class="col-md-12">
                <div class="row">
                    <div class="col-md-12">
                        <div class="pull-right prod-top-nav">
                            <a href="javascript:void(0)" data-toggle="popover" data-placement="bottom" class="popshare product_share"><i class="material-icons ">share</i> </a>
                            <?php if (!Yii::$app->user->isGuest): ?>
                                <a href="javascript:void(0)" class="product_subscribe" data-toggle="tooltip" title="subscribe"><i class="fa fa-paper-plane"></i></a>
                            <?php else: ?>
                                <a href="javascript:void(0)" class="product_subscribe popscrb" data-container="body" data-toggle="popover" data-placement="bottom" ><i class="fa fa-paper-plane"></i></a>
                            <?php endif; ?>
                            <a class="add-favorite" data-toggle="tooltip" title="<?= ($model->isFavorite(Yii::$app->user->identity->id)) ? 'remove from favorite' : 'add to favorite'; ?>"
                               href="javascript:void(0)">
                                <?php if(!Yii::$app->user->isGuest) :?>
                                <button id="<?php echo "heart_".$model->id; ?>" onclick="favorite(<?php echo $model->id ?>)" <?= ($model->isFavorite(Yii::$app->user->identity->id)) ? 'class="faved"' : ''; ?>>
                                <?php else :?>
                                    <button id="<?php echo "heart_".$model->id; ?>" class="popfvrt" data-container="body" data-toggle="popover" data-placement="bottom">
                                <?php endif; ?>

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
                    <div class="col-md-6">
                        <div class="single_image">
                            <?php echo backend\models\Product::getImagesToFront($model->id, 'image-zoom') ?>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="prod-info">
                            <h2><?php echo $model->name ?></h2>
                            <div class="rate">
                                <p>Rating: </p>
                                <input type="hidden" id="test_input" type="number"/>
                                <input type="hidden" id="product_id" type="number" value="<?php echo $model->id ?>"/>
                                <div class="w_review_stars w_modal_rating" data-mark="<?php echo $model->rate; ?>">
                                    <div class="w_stars">
                                        <div class="w_star_hover" data-rating="1"></div>
                                        <div class="w_star_hover" data-rating="2"></div>
                                    </div>
                                    <div class="w_stars">
                                        <div class="w_star_hover" data-rating="3"></div>
                                        <div class="w_star_hover" data-rating="4"></div>
                                    </div>
                                    <div class="w_stars">
                                        <div class="w_star_hover" data-rating="5"></div>
                                        <div class="w_star_hover" data-rating="6"></div>
                                    </div>
                                    <div class="w_stars">
                                        <div class="w_star_hover" data-rating="7"></div>
                                        <div class="w_star_hover" data-rating="8"></div>
                                    </div>
                                    <div class="w_stars">
                                        <div class="w_star_hover" data-rating="9"></div>
                                        <div class="w_star_hover" data-rating="10"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="product_description">
                            <?= $model->description?>

                        </div>
                        <?php foreach ($model->productPackage as $key => $package): ?>
                            <div class="product-nav">
                                <ul >
                                    <li>
                                        <p class="package_art">Art.no: <span id="package-art-no"><?php echo $package->art_num ?></span></p>
                                    </li>

                                    <li>
                                        <p class="package_weight">Weight:
                                            <span id="package-weight"><i><?php echo $package->weight ?></i> gram</span>
                                        </p>
                                    </li>
                                    <li>
                                        <?php $model->product_count > 0 ? $instock = 'check_circle' : $instock = 'cancel' ?>
                                        <span class="in_stock"><i class="material-icons <?php echo $model->product_count > 0 ? 'yes' : 'no' ?>"><?= $instock ?></i> <?php echo $model->product_count > 0 ? 'Available In' : 'Out of' ?> Stock</span>
                                    </li><br>

                                    <ul class="pull-right">
                                        <li>
                                            <div class="current_price">
                                                <span class="price prc_new  "><?php echo $package->price; ?></span>
                                            </div>
                                        </li>
                                        <li>
                                            <form action="#" class="shop-quantity">
                                                <button type="button" class="btn btn-b js-qty minus"
                                                        onclick="changeCount(this)"> -
                                                </button>

                                                <input type="text" value="1" id="input-number-<?= $package->id ?>"
                                                       class="input-quantity">
                                                <button type="button" class="btn btn-b js-qty plus" onclick="changeCount(this)">
                                                    +
                                                </button>
                                            </form>
                                        </li>
                                        <li>
                                            <?php foreach($model->productPackage as $key=>$value){ ?>

                                    <?php if($key == 0):?>
                                             <button class="btn btn-big item_add" id="item_buy"
                                                    onclick="buyProduct(<?= $model->id ?>,<?= $value->id; ?>)"><i
                                                    class="material-icons">shopping_cart</i> ADD TO CARD
                                            </button>
                                    <?php endif;?>
                                    <?php }?>
                                           
                                        </li>
                                    </ul>

                                </ul>
                            </div>

                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

  <div class="container comments">
    <h2>Comments</h2>
      <hr>
    <div class="comment_show_area">
        <?= $this->render('product_comment_view',['comments'=>$comments]) ?>
    </div>

      <div class="row">
          <div class="col-sm-10 col-sm-offset-1">
              <div class="form-group">
                      <textarea class="form-control" rows="5" id="comment_area"></textarea>
               </div>
          </div>
          <div class="col-sm-1 pd_left">
              <?php if (!Yii::$app->user->isGuest): ?>
                  <input type="hidden" id="user_id" value="<?= Yii::$app->user->identity->getId() ?>">
                  <input type="hidden" id='product_id' value="<?= $model->id ;?>">
                  <button type="button" class="btn btn-success com_btn" id='send_comment' >Add</button>
              <?php else: ?>
                  <button type="button" class="btn btn-success pop_comment com_btn" data-container="body" data-toggle="popover" data-placement="bottom" >Add</button>
                <?php endif;?>
          </div>
      </div>
  </div>

    <div class="container box single-box best_sellers">
        <h3 class="text-center fs14">CUSTOMERS WHO BOUGHT THIS PRODUCT ALSO BOUGHT</h3>
        <div class="best_items">
            <div class="col-md-3">
                <div class="item_best">
                    <img src="/images/best_sells/odens_cold.png" alt="">
                    <h4>Oden's Cold Portion</h4>
                    <span>CHEWINC TOBACCO</span>
                    <div class="best_prices">
                        <span class="price bst_prc_item prc_old">39.99</span>
                        <span class="price bst_prc_item prc_new">29.99</span>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="item_best">
                    <img src="/images/best_sells/odens_original.png" alt="">
                    <h4>Oden's Original Portion</h4>
                    <span>CHEWINC TOBACCO</span>
                    <div class="best_prices">
                        <span class="price bst_prc_item prc_old">29.99</span>
                        <span class="price bst_prc_item prc_new">19.99</span>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="item_best">
                    <img src="/images/best_sells/odens_salty.png" alt="">
                    <h4>WOW! Salty Stuff</h4>
                    <span>CHEWINC TOBACCO</span>
                    <div class="best_prices">
                        <span class="price bst_prc_item prc_old">49.99</span>
                        <span class="price bst_prc_item prc_new">39.99</span>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="item_best">
                    <img src="/images/best_sells/odens_taboca.png" alt="">
                    <h4>Taboca Original Portion</h4>
                    <span>CHEWINC TOBACCO</span>
                    <div class="best_prices">
                        <span class="price bst_prc_item prc_old">39.99</span>
                        <span class="price bst_prc_item prc_new">29.99</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

</section>
