<?php

use yii\helpers\Url;
use yii\helpers\Html;
use yii\data\ArrayDataProvider;
use backend\models\Files;
use backend\models\Blog;
use backend\models\TrBlog;
use backend\models\Slider;
use backend\models\HowToEarn;
use backend\models\InvestorPackages;

$this->title = Yii::t('app', 'Home');
$blog = Blog::findList(false, 3);
$sliders = Slider::find()->asArray()->all();
$how_to_earn = HowToEarn::findList();
$investor_packages = InvestorPackages::find()->asArray()->all();
?>
<div class="carousel-wrapper col-xs-12">
    <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
        <ol class="carousel-indicators">
            <?php foreach ($sliders as $key => $slider): ?>
                <li data-target="#carousel-example-generic" data-slide-to="<?= $key ?>" <?php if (!$key): ?>class="active"<?php endif; ?>></li>
            <?php endforeach; ?>
        </ol>
        <div class="carousel-inner" role="listbox">
            <?php foreach ($sliders as $key => $slider): ?>
                <div class="item <?php if (!$key): ?>active<?php endif; ?>">
                    <?= Files::getImagesToFront('slider', $slider['id']); ?>
                    <div class="carousel-caption">
                        <div class="title"><?= $slider['title'] ?></div>
                        <div class="description"><?= $slider['short_description'] ?></div>
                        <div class="view-more">
                            <a href="<?= $slider['link'] ?>">
                                <?= Yii::t('app', 'VIEW MORE') ?>...
                            </a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>
<?= $this->render('chart') ?>
<div class="price col-xs-12">
    <div class="container">
        <div class="paragraph">
            <span><?= Yii::t('app', 'How You can earn money with us') ?>?</span>
        </div>
        <?php foreach ($how_to_earn as $key => $earn): ?>
            <?php if (!$key || !($key % 2)): ?>
                <div class="fild-odd col-xs-12">
                    <div class="col-xs-12 col-sm-9 col-md-9 col-lg-9">
                        <div class="table-price">
                            <div class="cell-price">
                                <div class="info">
                                    <div class="number">
                                        <span><?= $key + 1 ?></span>
                                    </div>
                                    <div class="description"><?= $earn['short_description'] ?></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-3 col-md-3 col-lg-3">
                        <div class="table-price">
                            <div class="cell-price">
                                <?= Files::getImagesToFront('how_to_earn', $earn['how_to_earn_id']); ?>
                            </div>
                        </div>
                    </div>
                </div>
            <?php else: ?>
                <div class="fild-even col-xs-12">
                    <div class="col-xs-12 col-sm-3 col-md-3 col-lg-3">
                        <div class="table-price">
                            <div class="cell-price">
                                <?= Files::getImagesToFront('how_to_earn', $earn['how_to_earn_id']); ?>
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-9 col-md-9 col-lg-9">
                        <div class="table-price">
                            <div class="cell-price">
                                <div class="info">
                                    <div class="number">
                                        <span><?= $key + 1 ?></span>
                                    </div>
                                    <div class="description"><?= $earn['short_description'] ?></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
        <?php endforeach; ?>
    </div>
</div>

<div class="package col-xs-12">
    <div class="container">
        <div class="paragraph">
            <span><?= Yii::t('app', 'Investors Packages') ?></span>
        </div>
        <div class="">
            <?php foreach ($investor_packages as $key => $package): ?>
                <div class="col-xs-12 col-sm-6 col-md-4 col-lg-4">
                    <div class="pricetab">
                        <span class="title"><?= $package['title'] ?></span>
                        <div class="price"> 
                            <span><?= $package['price'] ?>$</span>
                        </div>
                        <div class="infos">
                            <?= $package['description'] ?>
                        </div>
                        <div class="pricefooter">
                            <div class="button">
                                <a href="#"><?= Yii::t('app', 'Buy') ?></a>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>	
        <?php foreach ($investor_packages as $key => $package): ?>
            <div class="colums col-xs-12 col-sm-6 col-md-4 col-lg-4 hidden">
                <div class="fild">
                    <div class="title"><span><?= $package['title'] ?></span></div>
                    <div class="sum"><span>от <?= $package['price'] ?>$</span></div>
                    <div class="info"><?= $package['description'] ?></div>
                    <div class="buy">
                        <a href="#"><?= Yii::t('app', 'Buy') ?></a>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>
<div class="investor col-xs-12" style="background-image: url(image/investor-banner.png);">
    <div class="layer"></div>
    <div class="container">
        <div class="info">
            <div class="paragraph">
                <span>Чем мы отличаемся от других инвесторских программ?</span>
            </div>
            <div class="col-xs-12 col-sm-3 col-md-3 col-lg-3 colums">
                <img src="image/icon-1.png" alt="" class="img-responsive">
                <div class="title">Можете начинать всего от 10$</div>
            </div>
            <div class="col-xs-12 col-sm-3 col-md-3 col-lg-3 colums">
                <img src="image/icon-2.png" alt="" class="img-responsive">
                <div class="title">Прозрачная система контроля</div>
            </div>
            <div class="col-xs-12 col-sm-3 col-md-3 col-lg-3 colums">
                <img src="image/icon-3.png" alt="" class="img-responsive">
                <div class="title">Всегда можете снять заработанные деньги.</div>
            </div>
            <div class="col-xs-12 col-sm-3 col-md-3 col-lg-3 colums">
                <img src="image/icon-4.png" alt="" class="img-responsive">
                <div class="title">Все участники имеют ограниченное количество рефералов</div>
            </div>
            <div class="col-xs-12 see-more">
                <a href="#">
                    Стать инвестором
                </a>
            </div>
        </div>
    </div>
</div> 
<div class="active-people col-xs-12">
    <div class="container">
        <div class="paragraph">
            <span>Самые активные участники</span>
        </div>
        <div class="col-xs-12 colums">
            <span class="num">1</span>
            <img src="image/people-250x250.jpg" alt="people-250x250.jpg" class="img-responsive">
            <div class="title">Name ( login )</div>
            <div class="sum">уже заработал 999$</div>
        </div>
        <div class="col-xs-12 colums">
            <span class="num">2</span>
            <img src="image/people-250x250.jpg" alt="people-250x250.jpg" class="img-responsive">
            <div class="title">Name ( login )</div>
            <div class="sum">уже заработал 599$</div>
        </div>
        <div class="col-xs-12 colums">
            <span class="num">3</span>
            <img src="image/people-250x250.jpg" alt="people-250x250.jpg" class="img-responsive">
            <div class="title">Name ( login )</div>
            <div class="sum">уже заработал 300$</div>
        </div>
        <div class="col-xs-12 colums">
            <span class="num">4</span>
            <img src="image/people-250x250.jpg" alt="people-250x250.jpg" class="img-responsive">
            <div class="title">Name ( login )</div>
            <div class="sum">уже заработал 300$</div>
        </div>
        <div class="col-xs-12 colums">
            <span class="num">5</span>
            <img src="image/people-250x250.jpg" alt="people-250x250.jpg" class="img-responsive">
            <div class="title">Name ( login )</div>
            <div class="sum">уже заработал 300$</div>
        </div>
    </div>
</div>		
<?= $this->render('calculator-range') ?>
<div class="info-calc col-xs-12">
    <div class="description col-xs-12">
        <div class="title">Остались вопросы? </div>
        <div class="txt">Читайте наш блог или Раздел Часто задаваемые вопросы или обратитесь в службу поддержки 24/7</div>
    </div>
</div>
<div class="news col-xs-12">
    <div class="container">
        <?php foreach ($blog as $statii): ?>
            <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4 colums">
                <a href="/<?= Yii::$app->language ?>/blog/<?= $statii['blog_id'] ?>" class="view-blog">
                    <?php echo Files::getImagesToFront('blog', $statii['blog_id'], 'img-responsive', $statii['title'], 1) ?>
                    <div class="title"><?= $statii['title'] ?></div>
                    <div class="see-date">
                        <div class="col-xs-12">
                            <div class="col-xs-6 see">
                                <i class="fa fa-eye" aria-hidden="true"></i><?= $statii['views'] ?>
                            </div>
                            <div class="col-xs-6 date"><?= date('d.m.Y', strtotime($statii['created_at'])) ?></div>
                        </div>
                    </div>
                </a>
            </div>
        <?php endforeach; ?>  
    </div>
</div>
