<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$this->registerCssFile("@web/js/rangeSlider/css/ion.rangeSlider.skinHTML5.css", [
    'depends' => [frontend\assets\AppAsset::className()]]);
$this->registerCssFile("@web/js/rangeSlider/css/ion.rangeSlider.css", [
    'depends' => [frontend\assets\AppAsset::className()]]);
$this->registerCssFile("@web/css/ion.css", [
    'depends' => [frontend\assets\AppAsset::className()]]);
?>      

<div class="calculator col-xs-12" style="background-image: url(image/calc-banner.png);">
    <div class="container">
        <div class="info">
            <div class="paragraph">
                <span>
                    Калькулятор доходов
                </span>
            </div>
            <div class="rate col-xs-12">
                <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
                    <div class="fild">
                        <label>
                            <img src="image/1.png" class="img-responsive">
                            <div class="title">Classic</div>
                            <div><input type="radio" onclick="changePackage('classic')" name="1" checked=""></div>
                        </label>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
                    <div class="fild">
                        <label>
                            <img src="image/2.png" class="img-responsive">
                            <div class="title">Silver</div>
                            <div><input type="radio" onclick="changePackage('silver')" name="1"></div>
                        </label>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
                    <div class="fild">
                        <label>
                            <img src="image/3.png" class="img-responsive">
                            <div class="title">Gold</div>
                            <div><input type="radio" onclick="changePackage('gold')" name="1"></div>
                        </label>
                    </div>
                </div>
            </div>
            <div class="calc col-xs-12">
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
                        <div class="txt">
                            Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                            tempor incididunt ut labore et dolore magna aliqua.	
                        </div>
                    </div>
                </div>
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
                <div class="description-calc col-xs-12">
                    Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                    tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
                    quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
                    consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
                    cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
                    proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
                </div>
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

            <div class="col-xs-12 see-more">
                <a href="javascript:void(0)" data-toggle="modal" data-target="#calculateModela">
                    <?=Yii::t('app','Calculate')?>
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
            <div class="description col-xs-12">
                <div class="title">Остались вопросы? </div>
                <div class="txt">Читайте наш блог или Раздел Часто задаваемые вопросы или обратитесь в службу поддержки 24/7</div>
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