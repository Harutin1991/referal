<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\helpers\Url;
/* @var $this yii\web\View */
/* @var $model backend\models\Pages */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Pages'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

$this->registerCssFile("@web/css/pages/portlet.css", [
    'depends' => [backend\assets\AppAsset::className()]]);
?>

<div class="row ui-sortable" >
    <div class="col-md-12 column sortable" id="sortable_portlets">
        <!-- BEGIN Portlet PORTLET-->
        <?php foreach($subPages as $key=>$pages):?>
        <div class="col-md-6 sortable-div" data-id="<?=$pages['pages_id']?>" data-order="<?=$pages['ordering']?>">
            <div class="portlet box <?php if(!$key):?>primary<?php elseif($key%3): ?>warning<?php elseif(!$key%2):?>success<?php endif;?>">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="livicon" data-c="#fff" data-hc="#fff" data-name="gift" data-size="18" data-loop="true"></i>
                        <?=$pages['title']?>
                    </div>
                    <div class="actions">
                        <a href="#" class="btn btn-default btn-sm">
                            <i class="fa fa-plus"></i>
                            Add
                        </a>
                        <a href="<?php echo Url::to(['update','id'=>$pages['pages_id']])?>" class="btn btn-default btn-sm">
                            <i class="fa fa-pencil"></i>
                            Edit
                        </a>
                    </div>
                </div>
                <div class="portlet-body">
                    <?php if($pages['short_description'] != '' || $pages['short_description'] != NULL):?>
                    <div><?=$pages['short_description']?></div>
                    <?php else:?>
                    <div><?=$pages['content']?></div>
                    <?php endif;?>
                </div>
            </div>
        </div>
        <?php endforeach;?>
    </div>
</div>
