<?php

use yii\helpers\Url;
use yii\helpers\Html;
use yii\data\ArrayDataProvider;
use backend\models\Files;
use backend\models\Blog;
use backend\models\TrBlog;
$this->title = Yii::t('app', 'Home');
$blog = Blog::findList(false,3);

?>
<div class="carousel-wrapper col-xs-12">
    <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
        <ol class="carousel-indicators">
            <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
            <li data-target="#carousel-example-generic" data-slide-to="1"></li>
            <li data-target="#carousel-example-generic" data-slide-to="2"></li>
        </ol>
        <div class="carousel-inner" role="listbox">
            <div class="item active">
                <img src="image/carousel.png" alt="">
                <div class="carousel-caption">
                    <div class="title">
                        Lorem Ipsum
                    </div>
                    <div class="description">
                        Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                        tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
                        quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
                        consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
                        cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
                        proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
                    </div>
                    <div class="view-more">
                        <a href="#">
                            VIEW MORE...
                        </a>
                    </div>
                </div>
            </div>

            <div class="item">
                <img src="image/carousel.png" alt="">
                <div class="carousel-caption">
                    <div class="title">
                        Lorem Ipsum
                    </div>
                    <div class="description">
                        Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                        tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
                        quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
                        consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
                        cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
                        proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
                    </div>
                    <div class="view-more">
                        <a href="#">
                            VIEW MORE...
                        </a>
                    </div>
                </div>
            </div>

            <div class="item">
                <img src="image/carousel.png" alt="">
                <div class="carousel-caption">
                    <div class="title">
                        Lorem Ipsum
                    </div>
                    <div class="description">
                        Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                        tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
                        quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
                        consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
                        cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
                        proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
                    </div>
                    <div class="view-more">
                        <a href="#">
                            VIEW MORE...
                        </a>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
<div class="counter col-xs-12">
    <div class="container">
        <div class="cols">
            <img src="image/counter/img-01.png">
            <div class="num">1856</div>
            <div class="title">зарегистрировано участников</div>
        </div>
        <div class="cols">
            <img src="image/counter/img-02.png">
            <div class="num">1600</div>
            <div class="title">активных участников</div>
        </div>
        <div class="cols">
            <img src="image/counter/img-03.png">
            <div class="num">3560</div>
            <div class="title">приглашеных участников</div>
        </div>
        <div class="cols">
            <img src="image/counter/img-04.png">
            <div class="num">65000$</div>
            <div class="title">инвестировано</div>
        </div>
        <div class="cols">
            <img src="image/counter/img-05.png">
            <div class="num">99000$</div>
            <div class="title">заработано</div>
        </div>
    </div>
</div>
<div class="price col-xs-12">
    <div class="container">
        <div class="paragraph">
            <span>Как можно зарабатывать с нами?</span>
        </div>

        <div class="fild-odd col-xs-12">
            <div class="col-xs-12 col-sm-9 col-md-9 col-lg-9">
                <div class="table-price">
                    <div class="cell-price">
                        <div class="info">
                            <div class="number">
                                <span>1</span>
                            </div>
                            <div class="description">
                                Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                                tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
                                quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
                                consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
                                cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
                                proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xs-12 col-sm-3 col-md-3 col-lg-3">
                <div class="table-price">
                    <div class="cell-price">
                        <img src="image/price.jpg" alt="">
                    </div>
                </div>
            </div>
        </div>

        <div class="fild-even col-xs-12">
            <div class="col-xs-12 col-sm-3 col-md-3 col-lg-3">
                <div class="table-price">
                    <div class="cell-price">
                        <img src="image/price.jpg" alt="">
                    </div>
                </div>
            </div>
            <div class="col-xs-12 col-sm-9 col-md-9 col-lg-9">
                <div class="table-price">
                    <div class="cell-price">
                        <div class="info">
                            <div class="number">
                                <span>2</span>
                            </div>
                            <div class="description">
                                Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                                tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
                                quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
                                consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
                                cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
                                proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="fild-odd col-xs-12">
            <div class="col-xs-12 col-sm-9 col-md-9 col-lg-9">
                <div class="table-price">
                    <div class="cell-price">
                        <div class="info">
                            <div class="number">
                                <span>1</span>
                            </div>
                            <div class="description">
                                Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                                tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
                                quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
                                consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
                                cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
                                proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xs-12 col-sm-3 col-md-3 col-lg-3">
                <div class="table-price">
                    <div class="cell-price">
                        <img src="image/price.jpg" alt="">
                    </div>
                </div>
            </div>
        </div>

        <div class="fild-even col-xs-12">
            <div class="col-xs-12 col-sm-3 col-md-3 col-lg-3">
                <div class="table-price">
                    <div class="cell-price">
                        <img src="image/price.jpg" alt="">
                    </div>
                </div>
            </div>
            <div class="col-xs-12 col-sm-9 col-md-9 col-lg-9">
                <div class="table-price">
                    <div class="cell-price">
                        <div class="info">
                            <div class="number">
                                <span>2</span>
                            </div>
                            <div class="description">
                                Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                                tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
                                quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
                                consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
                                cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
                                proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
<div class="package col-xs-12">
    <div class="container">
        <div class="paragraph">
            <span>Пакеты инвестора</span>
        </div>
        <div class="colums col-xs-12 col-sm-6 col-md-4 col-lg-4">
            <div class="title"><span>Classic</span></div>
            <div class="sum"><span>от 10$</span></div>
            <div class="info">
                <ul>
                    <li>Пакеты инвестора</li>
                    <li>Пакеты инвестора</li>
                    <li>Пакеты инвестора</li>
                    <li>Пакеты инвестора</li>
                    <li>Пакеты инвестора</li>
                    <li>Пакеты инвестора</li>
                    <li>Пакеты инвестора</li>
                </ul>
            </div>
            <div class="buy">
                <a href="#">Купить</a>
            </div>
        </div>
        <div class="colums col-xs-12 col-sm-6 col-md-4 col-lg-4">
            <div class="title"><span>Silver</span></div>
            <div class="sum"><span>от 50$</span></div>
            <div class="info">
                <ul>
                    <li>Пакеты инвестора</li>
                    <li>Пакеты инвестора</li>
                    <li>Пакеты инвестора</li>
                    <li>Пакеты инвестора</li>
                    <li>Пакеты инвестора</li>
                    <li>Пакеты инвестора</li>
                    <li>Пакеты инвестора</li>
                </ul>
            </div>
            <div class="buy">
                <a href="#">Купить</a>
            </div>
        </div>
        <div class="colums col-xs-12 col-sm-6 col-md-4 col-lg-4">
            <div class="title"><span>Gold</span></div>
            <div class="sum"><span>от 100$</span></div>
            <div class="info">
                <ul>
                    <li>Пакеты инвестора</li>
                    <li>Пакеты инвестора</li>
                    <li>Пакеты инвестора</li>
                    <li>Пакеты инвестора</li>
                    <li>Пакеты инвестора</li>
                    <li>Пакеты инвестора</li>
                    <li>Пакеты инвестора</li>
                </ul>
            </div>
            <div class="buy">
                <a href="#">Купить</a>
            </div>
        </div>
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
        <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4 colums">
            <span class="num">1</span>
            <img src="image/people-250x250.jpg" alt="people-250x250.jpg" class="img-responsive">
            <div class="title">Name ( login )</div>
            <div class="sum">уже заработал 999$</div>
        </div>
        <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4 colums">
            <span class="num">2</span>
            <img src="image/people-250x250.jpg" alt="people-250x250.jpg" class="img-responsive">
            <div class="title">Name ( login )</div>
            <div class="sum">уже заработал 599$</div>
        </div>
        <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4 colums">
            <span class="num">3</span>
            <img src="image/people-250x250.jpg" alt="people-250x250.jpg" class="img-responsive">
            <div class="title">Name ( login )</div>
            <div class="sum">уже заработал 300$</div>
        </div>
    </div>
</div>		
<div class="calculator col-xs-12" style="background-image: url(image/calc-banner.png);">
    <div class="container">
        <div class="info">
            <div class="paragraph">
                <span>
                    Калькулятор доходов
                </span>
            </div>
            <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6 range">
                <div class="selecteurPrix">
                    <div class="range-slider">
                        <input class="input-range" type="range" value="250" min="1" max="500">
                        <div class="valeurPrix">
                            <span class="range-value"></span>
                        </div>
                    </div>
                </div> 
            </div>
            <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6 range">
                <div class="selecteurPrix">
                    <div class="range-slider">
                        <input class="input-range" type="range" value="250" min="1" max="500">
                        <div class="valeurPrix">
                            <span class="range-values"></span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6 drops">
                <select>
                    <option>Пользователь может выбрать пакет</option>
                    <option>Пользователь может выбрать пакет</option>
                    <option>Пользователь может выбрать пакет</option>
                    <option>Пользователь может выбрать пакет</option>
                </select>
            </div>
            <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6 drops">
                <select>
                    <option>Пользователь может выбрать пакет</option>
                    <option>Пользователь может выбрать пакет</option>
                    <option>Пользователь может выбрать пакет</option>
                    <option>Пользователь может выбрать пакет</option>
                </select>
            </div>
            <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6 drops">
                <select>
                    <option>Пользователь может выбрать пакет</option>
                    <option>Пользователь может выбрать пакет</option>
                    <option>Пользователь может выбрать пакет</option>
                    <option>Пользователь может выбрать пакет</option>
                </select>
            </div>
            <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6 drops">
                <select>
                    <option>Пользователь может выбрать пакет</option>
                    <option>Пользователь может выбрать пакет</option>
                    <option>Пользователь может выбрать пакет</option>
                    <option>Пользователь может выбрать пакет</option>
                </select>
            </div>
            <div class="col-xs-12 see-more">
                <a href="">
                    Рассчитать
                </a>
            </div>
            <div class="description col-xs-12">
                <div class="title">Остались вопросы? </div>
                <div class="txt">Читайте наш блог или Раздел Часто задаваемые вопросы или обратитесь в службу поддержки 24/7</div>
            </div>
        </div>
    </div>
</div>
<div class="news col-xs-12">
    <div class="container">
	<?php foreach($blog as $statii):?>
        <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4 colums">
		 <a href="/<?= Yii::$app->language ?>/blog/<?= $statii['blog_id'] ?>" class="view-blog">
                        <?php echo Files::getImagesToFront('blog', $statii['blog_id'], 'img-responsive', $statii['title'], 1) ?>
                <div class="title"><?=$statii['title']?></div>
                <div class="see-date">
                    <div class="col-xs-12">
                        <div class="col-xs-6 see">
                            <i class="fa fa-eye" aria-hidden="true"></i><?=$statii['views']?>
                        </div>
                        <div class="col-xs-6 date"><?php date('d.m.Y',strtotime($statii['created_at']))?></div>
                    </div>
                </div>
            </a>
        </div>
		<?php endforeach;?>
    </div>
</div>
