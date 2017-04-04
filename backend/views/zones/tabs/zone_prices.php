<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

?>
<?php foreach ($arrZones as $zone) { ?>
    <div class="row mb5">
        <div class="col-sm-12">
            <div class="form-group pl15 ml40">
                <input type="hidden" name="zone" value="<?= $id; ?>">
                <div class="col-sm-6">
                    <label>Weight Interval</label>
                    <input type="text" name="<?='weight_from_'.$zone->id; ?>" value="<?= $zone->weight_from; ?>">
                    <label> to </label>

                    <input type="text" name="<?='weight_to_'.$zone->id; ?>" value="<?= $zone->weight_to; ?>">

                </div>
                <div class="col-sm-6">
                    <label>Price</label>
                    <input type="text" name="<?='price_'.$zone->id; ?>" value="<?= $zone->price; ?>">
                    <?= Html::button(Yii::t('app', 'Edit'), ['class' => 'btn btn-sm btn-primary ', 'onclick' => 'updatePrice('.$zone->id.')']) ?>
                    <?= Html::button(Yii::t('app', 'Delete'), ['class' => 'btn btn-sm btn-danger ', 'onclick' => 'deletePrice('.$zone->id.')']) ?>

                </div>
            </div>

        </div>

    </div>

    <div class="clearfix"></div>
<?php } ?>
<hr>
<div class="row">
    <div class="col-sm-12">
        <div class="form-group pl15 ml40">
            <input type="hidden" name="zone" value="<?= $id; ?>">
            <div class="col-sm-6">
                <label>Weight Interval</label>
                <input type="text" name="weight_from">
                <label> to </label>
                <input type="text" name="weight_to">
            </div>
            <div class="col-sm-6">
                <label>Price</label>
                <input type="text" name="price">

                <?= Html::submitButton(Yii::t('app', 'Add'), ['class' => 'btn btn-sm btn-success ', 'onclick' => 'addPrice()']) ?>

            </div>
        </div>

    </div>

</div>

