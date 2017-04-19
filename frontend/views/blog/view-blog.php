<?php
/* @var $this yii\web\View */

use yii\helpers\Html;
use backend\models\Files;
$this->title = $blog[0]['title'];
$this->params['breadcrumbs'][] = $this->title;
$date = date_create(date('Y-m-d',strtotime($blog[0]['created_at'])));
?>
<!--div class="container-fluid">
    <div class="content-page col-xs-12">
        <div class="title"><?= Html::encode($this->title) ?></div>
        <?php $file = Files::find()->where(['category'=>'blog','category_id'=>$blog[0]['blog_id']])->count(); if($file){ echo Files::getImagesToFront('blog',$blog[0]['blog_id'], 'img-responsive', $blog[0]['title'], 1);} ?>
        <!-- img src="image/banner.jpg" class="img-responsive hidden" -->
        <!--div class="txt"><?= $blog[0]['description'] ?></div>
    </div>
</div --->

<div id="blogContainer" class="minHeight">
    <div id="blog-item">
        <div class="container-fluid">
            <div class="row row-image">
			<?php $file = Files::find()->where(['category'=>'blog','category_id'=>$blog[0]['blog_id']])->count(); if($file){ ?>
			
                <div class="img-container">
                    <div class="image" style="background-image: url('<?php echo Files::getImagesPathToFront('blog',$blog[0]['blog_id'], 'img-responsive', $blog[0]['title'], 1); ?>')"></div>
                </div>
				<?php } ?>
                <div class="img-container-bg"></div>
                <div class="text-container">
                    <a href="/<?=Yii::$app->language?>/blog" class="href"><span class="glyphicon glyphicon-arrow-left"></span>Обратно в блог</a>
                    <h1><?= Html::encode($this->title) ?></h1>
                    <p><a href="javascript:void(0)" class="date"><?=date_format($date,'d').'&nbsp;'.Yii::t('app',date_format($date,'F')).'&nbsp;'.date_format($date,'Y');?></a><span class="view"><span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span>1</span></p>
                </div>
            </div>
            <div class="row row-max">
                <div class="text"><?= $blog[0]['description'] ?></div>
            </div>
        </div>
    </div>
</div>
