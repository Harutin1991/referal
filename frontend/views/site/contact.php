<?php
/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\ContactForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use backend\models\Contactus;
$this->title = 'Contact';
$this->params['breadcrumbs'][] = $this->title;
$themes = Contactus::find()->asArray()->all();
?>
<div class="support col-xs-12">
		<div class="container">
			<div class="paragraph">
				Поддержка
			</div>
			<div class="form-container">
			    <form method="post" role="form" action="" enctype="multipart/form-data">
			        <div class="form-group">
			            <select class="form-control" name="theme">
			                <option value="null" selected="selected">Выберите тему</option>
							<?php foreach($themes as $theme):?>
			                <option value=""><?=$theme['title']?></option>
							<?php endforeach;?>
			            </select>
			        </div>
			        <div class="form-group">
			            <label>Пожалуйста, подробно опишите свой вопрос. Наиболее полная информация поможет нам ответить на ваше обращение в кратчайшие сроки. Вы можете также приложить файл со снимком экрана.</label>
			            <textarea class="form-control" placeholder="Введите вопрос" cols="1" rows="5" name="question"></textarea>
			        </div>
			        <div class="form-group">
			            <input type="file" class="form-control" multiple="multiple" placeholder="Выберите файл" name="">
			        </div>
			        <div class="form-group">
			            <input type="text" class="form-control" placeholder="Ваша Фамилия, Имя и Отчетство" name="name" maxlength="255" value="">
			        </div>
			        <div class="form-group">
			            <p>Желаете, чтобы к вам перезвонил наш менеджер?</p>
			            <label class="radio-inline"><input type="radio" name="call">Да</label>
			            <label class="radio-inline"><input type="radio" name="call">Нет</label>
			        </div>
			        <div class="form-group">
			            <input type="number" class="form-control" placeholder="Введите номер" name="phone" maxlength="255" value="">
			        </div>
			        <div class="form-group">
			            <input type="email" class="form-control" placeholder="Введите эл.почту" name="email" maxlength="255" value="">
			        </div>
			        <div class="form-group">
			            <p class="text-center">
			                <img alt="" title="" src="/image/img-001.gif" width="150">
			            </p>
			            
			            <input type="text" class="form-control" placeholder="Введите код с картинки" name="capcha" maxlength="6" value="">
			        </div>
			        <div class="text-center">
			            <input type="submit" name="send" value="Отправить">
			        </div>
			    </form>
			</div>
		</div>
	</div>