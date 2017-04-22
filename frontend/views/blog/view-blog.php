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
<div class="container-fluid">
		<div class="blog-sub col-xs-12">
			<div class="fild row">
			<?php $file = Files::find()->where(['category'=>'blog','category_id'=>$blog[0]['blog_id']])->count(); if($file){ ?>
                <div class="img-center">
                    <div class="img" style="background-image: url('<?php echo Files::getImagesPathToFront('blog',$blog[0]['blog_id'], '', $blog[0]['title'], 1); ?>')"></div>
                </div>
				<?php } ?>
				<div class="layer"></div>
				<div class="description">
					<div class="goback">
						<a href="/<?=Yii::$app->language?>/blog">
							<i class="fa fa-long-arrow-left" aria-hidden="true"></i><?= Html::encode($this->title) ?>
						</a>
					</div>
					<div class="title"><?= Html::encode($this->title) ?></div>
					<div class="dateSee">
						<span class="date"><?=date_format($date,'d').'&nbsp;'.Yii::t('app',date_format($date,'F')).'&nbsp;'.date_format($date,'Y');?></span>
						<span class="see">
							<i class="fa fa-eye" aria-hidden="true"></i>1
						</span>
					</div>
				</div>
			</div> 
			<div class="container">
				<div class="txt"><?= $blog[0]['description'] ?></div>
			</div>
		</div>
	</div>
