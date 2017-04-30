<?php
$this->registerCssFile("@web/chart/css/jquery.circliful.css", [
    'depends' => [\frontend\assets\AppAsset::className()]]);
?>
<div class="counter col-xs-12">
    <div class="container">
        <div class="cols" id="circle1">
            <!--img src="image/counter/img-01.png" -->
        </div>
        <div class="cols" id="circle2">
            <!--<img src="image/counter/img-02.png">-->
<!--            <div class="num">1600</div>
            <div class="title">активных участников</div>-->
        </div>
        <div class="cols" id="circle3">
<!--            <img src="image/counter/img-03.png">
            <div class="num">3560</div>
            <div class="title">приглашеных участников</div>-->
        </div>
        <div class="cols" id="circle4">
<!--            <img src="image/counter/img-04.png">
            <div class="num">65000$</div>
            <div class="title">инвестировано</div>-->
        </div>
        <div class="cols" id="circle5">
<!--            <img src="image/counter/img-05.png">
            <div class="num">99000$</div>
            <div class="title">заработано</div>-->
        </div>
    </div>
</div>
<?php
$this->registerJsFile(
        '@web/chart/js/jquery.circliful.js', ['depends' => [\frontend\assets\AppAsset::className()]]
);
$this->registerJsFile(
        '@web/chart/chart-init.js', ['depends' => [\frontend\assets\AppAsset::className()]]
);
?>