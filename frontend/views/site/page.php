<?php
/* @var $this yii\web\View */

use yii\helpers\Html;
use backend\models\Files;
use frontend\models\Pages;
$this->title = $page[0]['title'];
$this->params['breadcrumbs'][] = $this->title;
if($page[0]['parent_id']){
	$otherPages = Pages::findOtherChildList($page[0]['parent_id'],$page[0]['pages_id']);
}

?>
<?php if(empty($subPage) && $page[0]['parent_id']):?>
<div class="container">
		<div class="use-of-sub col-xs-12">
			<div class="left-sidebar col-xs-12 col-sm-3 col-md-3 col-lg-3">
				<div class="col-xs-12 menubar">
					<ul>
						<li><a href="#">Вернуться в раздел</a></li>
						<?php foreach($otherPages as $page_other):?>
						<li><a href="/<?=Yii::$app->language?>/page/<?=$page_other['pages_id']?>"><?=$page_other['title']?></a></li>
						<?php endforeach;?>
					</ul>	
				</div>
			</div>
			
			<div class="right-sidebar col-xs-12 col-sm-9 col-md-9 col-lg-9">
				<div class="col-xs-12 info">
					<div class="paragraph"><?= Html::encode($this->title) ?></div>
					<div class="description">
					<?php $file = Files::find()->where(['category'=>'pages','category_id'=>$page[0]['pages_id']])->count(); 
					if($file){
						echo Files::getImagesToFront('pages',$page[0]['pages_id'], 'img-responsive img', $page[0]['title'], 1);
						} ?>
					<?= $page[0]['content'] ?>
					</div>
				</div>
			</div>
		</div>
	</div>
<?php elseif(!empty($subPage)):?>
<div class="container">
		<div class="use-of col-xs-12">
			<div class="paragraph"><?= Html::encode($this->title) ?></div>
			<?php foreach($subPage as $pages):?> 
			<?php $file = Files::find()->where(['category'=>'pages','category_id'=>$pages['pages_id']])->count();  ?>
			<div class="filds col-xs-12 col-sm-12 col-md-12 col-lg-12">
				<a href="/<?=Yii::$app->language?>/page/<?=$pages['pages_id']?>">
				<!-- if ete chka nkar stexic kdres -->
				
					<div class="img" <?php if (!$file): ?> style="display:none;"<?php endif; ?> >
						<div class="tablemiddle first">
		  					<div class="cellmiddle">
								 <?php 
								 if($file){ echo Files::getImagesToFront('pages',$pages['pages_id'], 'img-responsive', $pages['title']);} ?>
							</div>
						</div>
					</div>
					<!-- esqan -->
					<!-- secound divi mej nayes ete nkar@ chka style="width: 100%;"  -->
					<div class="tablemiddle secound" <?php if (!$file): ?> style="width:100%;"<?php endif; ?>>
      					<div class="cellmiddle">
							<div class="title"><?=$pages['title']?></div>
							<div class="description">
							<?= $pages['short_description'] ?>
							</div>
						</div>
					</div>
				</a>
			</div>
			<?php endforeach;?>
		</div>
	</div>
	<?php else: ?>
	<div class="container">
		<div class="content-page col-xs-12">
			<div class="title"><?= Html::encode($this->title) ?></div>
			<?php $file = Files::find()->where(['category'=>'pages','category_id'=>$page[0]['pages_id']])->count(); 
					if($file){
						echo Files::getImagesToFront('pages',$page[0]['pages_id'], 'img-responsive hidden', $page[0]['title'], 1);
						} ?>
			<div class="txt"><?= $page[0]['content'] ?></div>
		</div>
	</div>
<?php endif;?>  
