<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
?>
<div class="row">
    <div class="col-sm-6">

            <label class="control-label mb15">Countries</label>
            <div class="form-group">
                <?php $forms = ActiveForm::begin([
                    'action' => ['/zones/update-zone-countries'],
                    'id' => 'countries_form',
                ]); ?>


<input type="hidden" name="zone" value="<?= $id;?>">
                <div class="col-sm-12 pl15 ml40">
                    <?php foreach ($arrCountries as $country){
                    ?>
                    <div class="col-sm-6 checkbox-custom checkbox-primary mb5">
                        <input type="checkbox" name="countries[]" value="<?= $country['id'] ?>" id="<?= $country['id'] ?>" <?= ($country['zone_id'])?'checked':''; ?>>
                        <label for="<?= $country['id'] ?>"><?= $country['name'] ?></label>
                    </div>
                    <?php }?>
                </div>
                <div class="form-group">
                    <?= Html::submitButton( Yii::t('app', 'Save'), ['class' => 'btn btn-success pull-right']) ?>
                </div>
                <?php ActiveForm::end(); ?>

            </div>

    </div>

</div>
