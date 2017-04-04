<h3>Address</h3>
<br>
<ul>
    <li>Country
<!--        <span data-name="country" data-type="adrress">--><?//= $model->country; ?><!--</span><i class="material-icons edit">create</i>-->

        <div class="select-country">
            <select class="edit-country ">
                <option value="1">One</option>
                <option value="2">Two</option>
            </select>
        </div>
    </li>

    <li>State <span data-name="state" data-type="adrress"><?= $model->state; ?></span><i class="material-icons edit">create</i></li>
    <li>City <span data-name="city" data-type="adrress"><?= $model->city; ?></span><i class="material-icons edit">create</i></li>
    <li>Address <span data-name="address" data-type="adrress"><?= $model->address; ?></span><i class="material-icons edit">create</i></li>
    <li>Zip/Postal Code  <span data-name="zip" data-type="adrress"><?= $model->zip; ?></span><i class="material-icons edit">create</i></li>

</ul>