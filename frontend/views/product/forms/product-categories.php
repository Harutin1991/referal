<?php
$category_id = isset(Yii::$app->request->get()['id']) ? Yii::$app->request->get()['id']:0;
?>
<div class="widget">
    <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
        <div class="panel panel-default">
            <div class="panel-heading" role="tab" id="headingOne">
                <h4 class="panel-title">
                    <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne"
                       aria-expanded="true" aria-controls="collapseOne">
                        <?=
                        Yii::t('app','PRODUCTS BY CATEGORY');
                        ?>
                        <span class="caret"></span>
                    </a>
                </h4>
            </div>
            <div id="collapseOne" class="panel-collapse collapse in" role="tabpanel"
                 aria-labelledby="headingOne">
                <div class="panel-body">
                    
                </div>
            </div>
        </div>
    </div>
</div>