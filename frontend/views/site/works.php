<?php

use yii\helpers\Url;
use yii\helpers\Html;
use backend\models\Files;
$this->title = Yii::t('app','Our Works');

?>
<div class="main-section">
    <div class="container">
        <div class="service col-xs-12">
            <?php foreach($works as $serv):?>
            <div class="box col-xs-12">
                <div class="col-xs-12 col-sm-3 col-md-3 col-lg-3">
                    <?php echo Files::getImagesToFront('work', $serv['works_id'],'img-responsive',$serv['name'],1)?>
                </div>
                <div class="col-xs-12 col-sm-9 col-md-9 col-lg-9">
                    <div class="info">
                        <div class="title"><?=$serv['name']?></div>
                        <div class="txt"><?=$serv['short_description']?></div>
                        <div class="see-more">
                            <a href="/<?=Yii::$app->language?>/page/works/<?=$serv['url']?>">SEE MORE</a>
                        </div>
                    </div>
                </div>
            </div>
            <?php endforeach;?>
        </div>
    </div>
</div>