<?php
/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\ContactForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Contact';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="container">
    <div class="contact-page col-xs-12">
        <div class="information">
            <div class="left-sidebar col-xs-12 col-sm-6 col-md-6 col-lg-6">
                <form method="" action="">
                    <div class="form-group">
                        <input type="" placeholder="Name*" name="name">
                    </div>
                    <div class="form-group">
                        <input type="" placeholder="Email*" name="email">
                    </div>
                    <div class="form-group">
                        <input type="" placeholder="Theme*" name="theme">
                    </div>
                    <div class="form-group">
                        <textarea placeholder="Message..." name="message"></textarea>
                    </div>
                    <div class="form-group text-center">
                        <input type="submit" name="" value="Send Message">
                    </div>
                </form>
            </div>
            <div class="right-sidebar col-xs-12 col-sm-6 col-md-6 col-lg-6">
                <div class="title">
                    Contact
                </div>
                <div class="txt">
                    <p>
                        Profmont, VIN: 820324301566
                    </p>
                    <p>
                        Address: Armenia, 0069, Erevan Davit Anaxti poxoc., 10/10
                    </p>
                    <p>
                        Tel. (+374)77 35 55 55, (+374) 10 58 00 59
                    </p>
                </div>
            </div>
        </div>
        <div class="map">
            <iframe src="https://www.google.com/maps/embed?pb=!1m16!1m12!1m3!1d1276.6212864082986!2d44.53202621927273!3d40.2020726870864!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!2m1!1sProfmont!5e1!3m2!1sru!2s!4v1488881299847" height="450" frameborder="0" style="border:0" allowfullscreen></iframe>
        </div>
    </div>
</div>