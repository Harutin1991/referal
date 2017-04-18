<?php

use yii\helpers\Url;
?>
<div class="container-fluid">
    <div class="faq-page col-xs-12">
        <div class="title"><?=Yii::t('app','F.A.Q')?></div>
        <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
             <?php foreach ($faq as $value): ?>
            <div class="panel panel-default">
                <div class="panel-heading" role="tab" id="headingOne">
                    <h4 class="panel-title">
                        <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                            <i class="fa fa-caret-right" aria-hidden="true"></i><?=$value['title']?></a>
                    </h4>
                </div>
                <div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
                    <div class="panel-body"><?=$value['description']?>
                    </div>
                </div>
            </div>
             <?php endforeach; ?>
        </div>
    </div>
</div>
</div>
