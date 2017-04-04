<?php foreach($attributes as $attribute):?>
<div class="col-md-4">
    <div class="option-group field">

        <label class="block mt15 option option-primary" for="attribute_<?php echo $attribute['id']?>">
            <input type="checkbox" onclick="attributeChecked('<?php echo $attribute['id']?>',this.checked)" name="attribute_checked" id="attribute_<?php echo $attribute['id']?>">
            <span class="checkbox"></span> <?php echo $attribute['name']?>
        </label>
        <div class="form-group">
            <input type="text" disabled="disabled" name="ProductAttribute[value][<?php echo $attribute['id']?>]" class="form-control" id="attribute_value_<?php echo $attribute['id']?>" placeholder="Attribute Value">
        </div>
    </div>

</div>
<?php endforeach;?>

