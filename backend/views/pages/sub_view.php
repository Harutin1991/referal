<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\Pages */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Pages'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

$this->registerCssFile("@web/css/pages/portlet.css", [
    'depends' => [backend\assets\AppAsset::className()]]);
?>

<div class="row ui-sortable" id="sortable_portlets">
    <div class="col-md-4 column sortable">
        <!-- BEGIN Portlet PORTLET-->
        <div class=" portlet box primary">
            <div class="portlet-title">
                <div class="caption">
                    <i class="livicon" data-c="#fff" data-hc="#fff" data-name="gift" data-size="18" data-loop="true"></i>
                    Portlet
                </div>
                <div class="actions">
                    <a href="#" class="btn btn-default btn-sm">
                        <i class="fa fa-plus"></i>
                        Add
                    </a>
                    <a href="#" class="btn btn-default btn-sm">
                        <i class="fa fa-pencil"></i>
                        Edit
                    </a>
                </div>
            </div>
            <div class="portlet-body">
                <div>
                    Tom loves Canada. Angela and Tom met. Angela and Tom want to play. Angela and Tom want to jump. Angela and Tom want to yell. Angela and Tom play, jump and yell.
                </div>
            </div>
        </div>
        <!-- END Portlet PORTLET-->
        <!-- BEGIN Portlet PORTLET-->
        <div class=" portlet box warning">
            <div class="portlet-title">
                <div class="caption">
                    <i class="livicon" data-c="#fff" data-hc="#fff" data-name="gift" data-size="18" data-loop="true"></i>
                    Portlet
                </div>
                <div class="actions">
                    <a href="#" class="btn btn-default btn-sm">
                        <i class="fa fa-plus"></i>
                        Add
                    </a>
                    <a href="#" class="btn btn-default btn-sm">
                        <i class="fa fa-pencil"></i>
                        Edit
                    </a>
                </div>
            </div>
            <div class="portlet-body">
                <div>
                    Tom loves Canada. Angela and Tom met. Angela and Tom want to play. Angela and Tom want to jump. Angela and Tom want to yell. Angela and Tom play, jump and yell.
                </div>
            </div>
        </div>
        <!-- END Portlet PORTLET-->
        <!-- BEGIN Portlet PORTLET-->
        <div class=" portlet box primary">
            <div class="portlet-title">
                <div class="caption">
                    <i class="livicon" data-c="#fff" data-hc="#fff" data-name="gift" data-size="18" data-loop="true"></i>
                    Portlet
                </div>
                <div class="actions">
                    <a href="#" class="btn btn-default btn-sm">
                        <i class="fa fa-plus"></i>
                        Add
                    </a>
                    <a href="#" class="btn btn-default btn-sm">
                        <i class="fa fa-pencil"></i>
                        Edit
                    </a>
                </div>
            </div>
            <div class="portlet-body">
                <div>
                    Tom loves Canada. Angela and Tom met. Angela and Tom want to play. Angela and Tom want to jump. Angela and Tom want to yell. Angela and Tom play, jump and yell.
                </div>
            </div>
        </div>
        <!-- END Portlet PORTLET-->
    </div>
    <div class="col-md-4 column sortable">
        <!-- BEGIN Portlet PORTLET-->
        <div class=" portlet box success">
            <div class="portlet-title">
                <div class="caption">
                    <i class="livicon" data-c="#fff" data-hc="#fff" data-name="gift" data-size="18" data-loop="true"></i>
                    Portlet
                </div>
                <div class="actions">
                    <a href="#" class="btn btn-default btn-sm">
                        <i class="fa fa-plus"></i>
                        Add
                    </a>
                    <a href="#" class="btn btn-default btn-sm">
                        <i class="fa fa-pencil"></i>
                        Edit
                    </a>
                </div>
            </div>
            <div class="portlet-body">
                <div>
                    Tom loves Canada. Angela and Tom met. Angela and Tom want to play. Angela and Tom want to jump. Angela and Tom want to yell. Angela and Tom play, jump and yell.
                </div>
            </div>
        </div>
        <!-- END Portlet PORTLET-->
        <!-- BEGIN Portlet PORTLET-->
        <div class="portlet box danger">
            <div class="portlet-title">
                <div class="caption">
                    <i class="livicon" data-c="#fff" data-hc="#fff" data-name="gift" data-size="18" data-loop="true"></i>
                    Portlet
                </div>
                <div class="actions">
                    <a href="#" class="btn btn-default btn-sm">
                        <i class="fa fa-plus"></i>
                        Add
                    </a>
                    <a href="#" class="btn btn-default btn-sm">
                        <i class="fa fa-pencil"></i>
                        Edit
                    </a>
                </div>
            </div>
            <div class="portlet-body">
                <div>
                    Tom loves Canada. Angela and Tom met. Angela and Tom want to play. Angela and Tom want to jump. Angela and Tom want to yell. Angela and Tom play, jump and yell.
                </div>
            </div>
        </div>
        <!-- END Portlet PORTLET-->
        <!-- BEGIN Portlet PORTLET-->
        <div class=" portlet box success">
            <div class="portlet-title">
                <div class="caption">
                    <i class="livicon" data-c="#fff" data-hc="#fff" data-name="gift" data-size="18" data-loop="true"></i>
                    Portlet
                </div>
                <div class="actions">
                    <a href="#" class="btn btn-default btn-sm">
                        <i class="fa fa-plus"></i>
                        Add
                    </a>
                    <a href="#" class="btn btn-default btn-sm">
                        <i class="fa fa-pencil"></i>
                        Edit
                    </a>
                </div>
            </div>
            <div class="portlet-body">
                <div>
                    Tom loves Canada. Angela and Tom met. Angela and Tom want to play. Angela and Tom want to jump. Angela and Tom want to yell. Angela and Tom play, jump and yell.
                </div>
            </div>
        </div>
        <!-- END Portlet PORTLET-->
    </div>
    <div class="col-md-4 column sortable">
        <!-- BEGIN Portlet PORTLET-->
        <div class=" portlet box info">
            <div class="portlet-title">
                <div class="caption">
                    <i class="livicon" data-c="#fff" data-hc="#fff" data-name="gift" data-size="18" data-loop="true"></i>
                    Portlet
                </div>
                <div class="actions">
                    <a href="#" class="btn btn-default btn-sm">
                        <i class="fa fa-plus"></i>
                        Add
                    </a>
                    <a href="#" class="btn btn-default btn-sm">
                        <i class="fa fa-pencil"></i>
                        Edit
                    </a>
                </div>
            </div>
            <div class="portlet-body">
                <div>
                    Tom loves Canada. Angela and Tom met. Angela and Tom want to play. Angela and Tom want to jump. Angela and Tom want to yell. Angela and Tom play, jump and yell.
                </div>
            </div>
        </div>
        <!-- END Portlet PORTLET-->
        <!-- BEGIN Portlet PORTLET-->
        <div class=" portlet box default">
            <div class="portlet-title">
                <div class="caption">
                    <i class="livicon" data-c="#fff" data-hc="#fff" data-name="gift" data-size="18" data-loop="true"></i>
                    Portlet
                </div>
                <div class="actions">
                    <a href="#" class="btn btn-default btn-sm">
                        <i class="fa fa-plus"></i>
                        Add
                    </a>
                    <a href="#" class="btn btn-default btn-sm">
                        <i class="fa fa-pencil"></i>
                        Edit
                    </a>
                </div>
            </div>
            <div class="portlet-body">
                <div>
                    Tom loves Canada. Angela and Tom met. Angela and Tom want to play. Angela and Tom want to jump. Angela and Tom want to yell. Angela and Tom play, jump and yell.
                </div>
            </div>
        </div>
        <!-- END Portlet PORTLET-->
        <!-- BEGIN Portlet PORTLET-->
        <div class=" portlet box info">
            <div class="portlet-title">
                <div class="caption">
                    <i class="livicon" data-c="#fff" data-hc="#fff" data-name="gift" data-size="18" data-loop="true"></i>
                    Portlet
                </div>
                <div class="actions">
                    <a href="#" class="btn btn-default btn-sm">
                        <i class="fa fa-plus"></i>
                        Add
                    </a>
                    <a href="#" class="btn btn-default btn-sm">
                        <i class="fa fa-pencil"></i>
                        Edit
                    </a>
                </div>
            </div>
            <div class="portlet-body">
                <div>
                    Tom loves Canada. Angela and Tom met. Angela and Tom want to play. Angela and Tom want to jump. Angela and Tom want to yell. Angela and Tom play, jump and yell.
                </div>
            </div>
        </div>
        <!-- END Portlet PORTLET-->
    </div>
</div>


<?php
$this->registerJs('
 $("#sortable_portlets").sortable({
            connectWith: ".portlet",
            items: ".portlet",
            opacity: 0.8,
            coneHelperSize: true,
            placeholder: "sortable-box-placeholder round-all",
            forcePlaceholderSize: true,
            tolerance: "pointer"
        });
        $(".column").disableSelection();
')
?>