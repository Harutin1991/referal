<?php
use backend\models\Files;
use backend\models\Calculator;
use backend\models\Packages;
use backend\models\PackageMessages;
$calculatorOption = Calculator::find()->asArray()->one();
$calcBackground = Files::find()->where(['category'=>'calculator','category_id'=>$calculatorOption['id']])->asArray()->one();
$packages = Packages::find()->asArray()->all();


$this->registerCssFile("@web/js/rangeSlider/css/ion.rangeSlider.skinHTML5.css", [
    'depends' => [frontend\assets\AppAsset::className()]]);
$this->registerCssFile("@web/js/rangeSlider/css/ion.rangeSlider.css", [
    'depends' => [frontend\assets\AppAsset::className()]]);
$this->registerCssFile("@web/css/ion.css", [
    'depends' => [frontend\assets\AppAsset::className()]]);
?>      

<div class="calculator col-xs-12" style="background-image: url('<?=Yii::$app->params['adminUrl'].'/uploads/images/calculator/'.$calculatorOption['id'].'/'.$calcBackground['path']?>');">
    <div class="container">
        <div class="info">
            <div class="paragraph">
                <span><?=$calculatorOption['title']?></span>
            </div>
            <div class="rate col-xs-12">
                <?php foreach($packages as $key=>$pack):?>
                <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
                    <div class="fild">
                        <label>
                            <img src="image/<?=$key+1?>.png" class="img-responsive">
                            <div class="title"><?=$pack['title']?></div>
                            <div><input type="radio" onclick="changePackage('<?=lcfirst($pack['title'])?>')" name="1" <?php if(!$key):?>checked=""<?php endif;?>></div>
                        </label>
                    </div>
                </div>
                <?php endforeach;?>
            </div>
            <div class="calc col-xs-12">
                <?php //foreach($packages as $key=>$pack):?>
                <?php //$message = PackageMessages::find()->where(['package_id'=>$pack['id']])->all();?> 
                <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6 range">
                    <div class="selecteurPrix">
                        <div class="range-slider">
                            <input class="input-range" id="range_1" >
                            <div class="valeurPrix">
                                <span class="range-value" id="range-value1"></span>
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-12 info">
                        <span class="caret"></span>
                        <div class="txt"> Lorem ipsum dolor sit amet, consectetur adipisicing elit </div>
                    </div>
                </div>
                <?php //endforeach;?>
                <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6 range">
                    <div class="selecteurPrix">
                        <div class="range-slider">
                            <input class="input-range" id="range_2">
                            <div class="valeurPrix">
                                <span class="range-values" id="range-value2"></span>
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-12 info">
                        <span class="caret"></span>
                        <div class="txt">
                            Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                            tempor incididunt ut labore et dolore magna aliqua.	
                        </div>
                    </div> 
                </div>
                <div class="description-calc col-xs-12" style="display:none;"><?=$calculatorOption['short_description']?></div>
                <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6 range" id="package_range_3" style="display: none;">
                    <div class="selecteurPrix">
                        <div class="range-slider">
                            <input class="input-range" id="range_3">
                            <div class="valeurPrix">
                                <span class="range-value" id="range-value3"></span>
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-12 info">
                        <span class="caret"></span>
                        <div class="txt">
                            Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                            tempor incididunt ut labore et dolore magna aliqua.	
                        </div>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6 range" id="package_range_4" style="display: none;">
                    <div class="selecteurPrix">
                        <div class="range-slider">
                            <input class="input-range" id="range_4">
                            <div class="valeurPrix">
                                <span class="range-values" id="range-value4"></span>
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-12 info">
                        <span class="caret"></span>
                        <div class="txt">
                            Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                            tempor incididunt ut labore et dolore magna aliqua.	
                        </div>
                    </div> 
                </div>
            </div>
            <div class="col-xs-12 see-more paragraph">
                <span id="calculate_button"><?=Yii::t('app','Calculate')?></span><span id="calculation_button" style="display:none;"><?=Yii::t('app','Calculation')?>: <p id="calculation_result" style="display: inline;"></p></span>
            </div>
            <div class="col-xs-12 see-more hidden">
                <a href="javascript:void(0)" data-toggle="modal" data-target="#calculateModela">
                    
                </a>
            </div>
            <div id="calculateModela" class="modal fade" role="dialog">
                <div class="modal-dialog">

                    <!-- Modal content-->
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title"><?=Yii::t('app','Calculation Result')?></h4>
                        </div>
                        <div class="modal-body">
                            <p style="display: inline; font-size: 20px;"><?=Yii::t('app','Your income')?> : </p><span id="calculationResult" style="font-size: 20px;margin-left: 4px;"></span>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>       
<?php
$this->registerJsFile(
        '@web/js/rangeSlider/js/ion.rangeSlider.js', ['depends' => [\yii\web\JqueryAsset::className()]]
);
$this->registerJsFile(
        '@web/js/slider.js', ['depends' => [\yii\web\JqueryAsset::className()]]
);
?>