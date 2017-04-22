<?php

use yii\helpers\Url;
?>
<div class="container">
    <div class="faq-page col-xs-12">
        <div class="title"><?=Yii::t('app','F.A.Q')?></div>
        <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
             <?php foreach ($faq as $key=>$value): ?>
            <div class="panel panel-default">
                <div class="panel-heading" role="tab" id="headingOne_<?=$key?>">
                    <h4 class="panel-title">
                        <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne_<?=$key?>" aria-expanded="true" aria-controls="collapseOne">
                            <i class="fa fa-caret-right" aria-hidden="true"></i>
							<span class="question"><?=Yii::t('app','Question')?>:</span>&nbsp;<?=$value['title']?></a>
                    </h4>
                </div>
                <div id="collapseOne_<?=$key?>" class="panel-collapse collapse <?php if(!$key):?>in<?php endif;?>" role="tabpanel" aria-labelledby="headingOne_<?=$key?>">
                    
					<div class="panel-body">
					<p class="answer">Ответ:</p>
					<?=$value['description']?>
                    </div>
                </div>
            </div>
             <?php endforeach; ?>
        </div>
    </div>
</div>
</div>
