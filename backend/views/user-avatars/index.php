<?php

use yii\helpers\Html;
use yii\grid\GridView;


/* @var $this yii\web\View */
/* @var $searchModel backend\models\UserAvatarsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'User Avatars');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="row">
    <?= Html::a('<i class="fa fa-plus fa-plus-square pr5"></i>'.Yii::t('app', 'Upload New Avatar'), ['create'], ['class' => 'btn btn-responsive button-alignment btn-success']);?>
    <div class="col-md-12">
        <div class="avatars-index">

            <?php if (!empty($images)) : ?>
                <?php foreach ($images as $key => $imagePath): ?>
                    <div style="display: inline-block;"
                         class="mix label1 folder1"
                         id="image_<?php echo $imagePath['id'] ?>">
                        <span class="close remove">
                            <i class="fa fa-close icon-close-materials icon-close-avatars"></i>
                        </span>
                        <div class="panel p6 pbn">
                            <div class="of-h">
                                <?php
                                echo Html::img('/uploads/images/user_avatars/thumbnail/' . $imagePath['path'], [
                                    'class' => 'img-responsive',
                                    'title' => $imagePath['id'],
                                    'alt' => '',
                                ])
                                ?>
                            </div>

                        </div>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </div>
</div>
