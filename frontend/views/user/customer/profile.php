<?php

use yii\helpers\Html;
use kartik\growl\Growl;
use yii\bootstrap\ActiveForm;
use kartik\select2\Select2;
use dosamigos\fileupload\FileUpload;
use frontend\models\UserImages;

/* @var $this yii\web\View */
/* @var $UserModel common\models\CustomerAddress */
/* @var $favorites common\models\Product[] */
?>

<?php
$modelFiles = new UserImages();
$link = Yii::$app->params['homeURL'] . 'refereal-link/u#' . Yii::$app->user->identity->id . '/' . $referalLink->referal_link;
if (Yii::$app->user->identity->role == 20):
    ?>
    <?php
    $address = '';
    $CustomerAddress = $UserModel->getDefaultAddress($UserModel->id);
    if (isset($CustomerAddress[0]) && !empty($CustomerAddress[0])) {
        $address = $CustomerAddress[0]['address'] . ', ' . $CustomerAddress[0]['city'] . ', ' . $CustomerAddress[0]['state'] . ', ' . $CustomerAddress[0]['country'];
    } else {
        $address = '';
    }
    ?>
<?php elseif (Yii::$app->user->identity->role == 10): ?>
    <?php
    $address = $UserModel->address . ', ' . $UserModel->city . ', ' . $UserModel->state . ', ' . $UserModel->country;
    echo $address
    ?>
<?php endif; ?>

<!-- ============================================= -->
<!--section id="account">
    <div class="container">
        <div class="row box account-content">
            <div class="col-sm-12">
                <div class="row">
                    <div class="col-sm-12 account-head">
                        <h1>Account Information</h1>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
                        <h3>Contact informations</h3>
                        <br>
                        <ul>
                            <li class="info-row">First Name <span
                                    data-name="name"><?= ucfirst($UserModel->first_name); ?></span></li>
                            <li class="info-row">Last Name <span
                                    data-name="surname"><?= ucfirst($UserModel->last_name); ?></span></li>
                            <li class="info-row">Phone Number <span
                                    data-name="phone"><?php echo $UserModel->phone ? $UserModel->phone : "<span class='unverfy'><i class=\"material-icons\">&#xE001;</i>not verifyed</span>"; ?></span></li>
                            <li class="info-row">Mobile Number <span
                                    data-name="phone"><?php echo $UserModel->phone ? $UserModel->phone : "<span class='unverfy'><i class=\"material-icons\">&#xE001;</i>not verifyed</span>"; ?></span></li>
                            <li class="info-row">Email <span data-name="email"><?= $UserModel->email; ?></span></li>
                            <input id="user_id" type="hidden" value="<?= ucfirst($UserModel->id); ?>">
                        </ul>
                    </div>
<?php echo $addressForm; ?>
                </div>
<!--div class="row" id="account_tab">
<?php
echo \yii\bootstrap\Tabs::widget([
    'items' => [
        [
            'label' => 'History',
            'content' => $this->render('history'),
            'active' => true
        ],
        [
            'label' => 'Favorites',
            'content' => $this->render('favorites', ['products' => $favorites]),
            'headerOptions' => [''],
            'options' => ['id' => 'myveryownID'],
        ],
    ],
]);
?>
    
</div >
</div>
</div>
</div>
</section -->

<div class="user-profile col-xs-12">
    <div class="container">
        <div class="left-bar col-xs-12 col-sm-5 col-md-5 col-lg-5">
            <div class="img-file">
                <div class="form-group">
                    <div class="text-center">
                        <?php
                        $form = ActiveForm::begin([
                                    'action' => ['user/upload-image'],
                                    'id' => 'user-image',
                        ]);
                        ?>
                        <div class="fileinput fileinput-new" data-provides="fileinput">

                            <div class="fileinput-new thumbnail">
                                <?= Html::img('@web/image/img-00001.jpg', ['id' => 'profile-img-tag', 'class' => 'img-responsive']); ?>
                            </div>

                            <div class="upload-btn">
                                <span class="btn btn-default btn-file">
                                    <span class="fileinput-new">Select image</span>
                                    <span class="fileinput-exists">Change</span>
                                    <?=
                                            $form->field($modelFiles, 'path[]')
                                            ->fileInput(
                                                    [
                                                        'multiple' => false,
                                                        'id' => 'profile-img',
                                                        'accept' => 'image/*',
                                                        'onchange' => 'showMyImage(this, -1)',
                                                        'class' => 'inputfile inputfile-6',
                                                        'data-multiple-caption' => "{count} files selected",
                                            ])->label(false)
                                    ?>

                                </span>
                                <a href="javascript:void(0);" class="btn btn-default fileinput-exists hidden" data-dismiss="fileinput">Remove</a>
                            </div>
                        </div>
                        <div class="avatar col-xs-12">
                            <div class="col-xs-12 col-sm-3 col-md-3 col-lg-3">
                                <div class="box">
                                    <img src="/image/avatar-1.png" alt="">
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-3 col-md-3 col-lg-3">
                                <div class="box">
                                    <img src="/image/avatar-3.png" alt="">
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-3 col-md-3 col-lg-3">
                                <div class="box">
                                    <img src="/image/avatar-2.png" alt="">
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-3 col-md-3 col-lg-3">
                                <div class="box">
                                    <img src="/image/avatar-4.png" alt="">
                                </div>
                            </div>
                        </div>
                        <?php ActiveForm::end(); ?>
                    </div>
                </div>
            </div>
            <div class="user-info col-xs-12">
                <div class="table-responsive">
                    <div class="share">
                        <div class="form-group">
                            <div class="input-group">
                                <input type="text" class="form-control" id="refreal-link" value="<?= $link ?>" placeholder="Link..." aria-describedby="basic-addon1">
                                <span class="input-group-addon" id="basic-addon1">
                                    <i class="fa fa-link" aria-hidden="true" id="copy-referal"></i>
                                </span>
                            </div>
                        </div>
                    </div>
                    <table class="table table-striped" id="users">
                        <tbody>
                            <tr>
                                <td><?= Yii::t('app', 'First Name') ?></td>
                                <td>
                                    <input type="text" name="first_name" id="first_name" onfocusout="saveUserData(this,'Customer')" value="<?= ucfirst($UserModel->first_name); ?>" disabled class="changeable">
                                </td>
                                <td>
                                    <span class="change">
                                        <i class="fa fa-pencil" onclick="pencileEdit('first_name', this);" aria-hidden="true"></i>
                                    </span>
                                </td>
                            </tr>
                            <tr>
                                <td><?= Yii::t('app', 'Last Name') ?></td>
                                <td>
                                    <input type="text" name="last_name" id="last_name" onfocusout="saveUserData(this,'Customer')" value="<?= ucfirst($UserModel->last_name); ?>" disabled class="changeable">
                                </td>
                                <td>
                                    <span class="change">
                                        <i class="fa fa-pencil" onclick="pencileEdit('first_name', this);" aria-hidden="true"></i>
                                    </span>
                                </td>
                            </tr>
                            <tr>
                                <td><?= Yii::t('app', 'Username') ?></td>
                                <td>
                                    <input type="text" name="username" id="username" onfocusout="saveUserData(this,'User')" value="<?= Yii::$app->user->identity->username; ?>" disabled class="changeable">
                                </td>
                                <td>
                                    <span class="change">
                                        <i class="fa fa-pencil" onclick="pencileEdit('username', this);"  aria-hidden="true"></i>
                                    </span>
                                </td>
                            </tr>
                            <tr>
                                <td>Email</td>
                                <td>
                                    <input type="text" name="email" id="email" onfocusout="saveUserData(this,'User')" value="<?= Yii::$app->user->identity->email; ?>" disabled class="changeable">
                                </td>
                                <td>
                                    <span class="change">
                                        <i class="fa fa-pencil" onclick="pencileEdit('email', this);" aria-hidden="true"></i>
                                    </span>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    Phone Number
                                </td>
                                <td>
                                    <input type="text" name="phone" id="phone" onfocusout="saveUserData(this,'Customer')" value="<?= $UserModel->phone ?>" disabled class="changeable">
                                </td>
                                <td>
                                    <span class="change">
                                        <i class="fa fa-pencil" onclick="pencileEdit('phone', this);" aria-hidden="true"></i>
                                    </span>
                                </td>
                            </tr>
                            <tr>
                                <td>Address</td>
                                <td>
                                    <?php if (!empty($UserModel->customerAddresses[0]->address)): ?>
                                        <input type="text" name="address" id="address" onfocusout="saveUserData(this,'CustomerAddress')" value="<?= $UserModel->customerAddresses[0]->address ?>" disabled class="changeable">
                                    <?php else: ?>
                                        <input type="text" name="address" id="address" onfocusout="saveUserData(this,'CustomerAddress')" class="changeable">
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <span class="change">
                                        <i class="fa fa-pencil" onclick="pencileEdit('address', this);" aria-hidden="true"></i>
                                    </span>
                                </td>
                            </tr>
                            <tr>
                                <td>City</td>
                                <td>
                                    <?php if (!empty($UserModel->customerAddresses[0]->city)): ?>
                                        <input type="text" name="city" id="city" onfocusout="saveUserData(this,'CustomerAddress')" value="<?= $UserModel->customerAddresses[0]->city ?>" disabled class="changeable">
                                    <?php else: ?>
                                        <input type="text" name="city" id="city" onfocusout="saveUserData(this,'CustomerAddress')" class="changeable">
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <span class="change">
                                        <i class="fa fa-pencil" onclick="pencileEdit('city', this);" aria-hidden="true"></i>
                                    </span>
                                </td>
                            </tr>
                            <tr>
                                <td>Country</td>
                                <td>
                                    <?php if (!empty($UserModel->customerAddresses[0]->country)): ?>
                                        <input type="text" name="country" id="city" onfocusout="saveUserData(this,'CustomerAddress')" value="<?= $UserModel->customerAddresses[0]->country ?>" disabled class="changeable">
                                    <?php else: ?>
                                        <input type="text" name="country" id="city" onfocusout="saveUserData(this,'CustomerAddress')" class="changeable">
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <span class="change">
                                        <i class="fa fa-pencil" onclick="pencileEdit('country', this);" aria-hidden="true"></i>
                                    </span>
                                </td>
                            </tr>
                            <tr>
                                <td>Status</td>
                                <td>
                                    <div class="actived">Activated</div>
                                </td>
                                <td>
                                    <span class="change">
                                        <i class="fa fa-pencil hidden" aria-hidden="true"></i>
                                    </span>
                                </td>
                            </tr>
                            <tr>
                                <td>Created At</td>
                                <td>
                                    <div class="nochangeable"><?= Yii::$app->user->identity->created ?></div>
                                </td>
                                <td>
                                    <span class="change">
                                        <i class="fa fa-pencil hidden" aria-hidden="true"></i>
                                    </span>
                                </td>
                            </tr>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="right-bar col-xs-12 col-sm-7 col-md-7 col-lg-7">
            <div class="param">
                <ul class="nav nav-tabs" role="tablist">
                    <li role="presentation" class="active">
                        <a href="#home" aria-controls="home" role="tab" data-toggle="tab">
                            <i class="fa fa-comments" aria-hidden="true"></i>
                            Home
                        </a>
                    </li>
                    <li role="presentation">
                        <a href="#messages" aria-controls="Messages" role="tab" data-toggle="tab">
                            <i class="fa fa-envelope" aria-hidden="true"></i>
                            Messages
                            <span class="badge">1</span>
                        </a>
                    </li>
                    <li role="presentation">
                        <a href="#changepassword" aria-controls="Change Password" role="tab" data-toggle="tab">
                            <i class="fa fa-key" aria-hidden="true"></i>
                            Change Password
                        </a>
                    </li>
                    <li role="presentation">
                        <a href="#settings" aria-controls="settings" role="tab" data-toggle="tab">
                            <i class="fa fa-cog" aria-hidden="true"></i>
                            Settings
                        </a>
                    </li>
                </ul>

                <div class="tab-content">
                    <div role="tabpanel" class="tab-pane active home" id="home">
                        <div class="imgs-profile">

                        </div>
                    </div>
                    <div role="tabpanel" class="tab-pane" id="messages">
                        <div id="tab-messages" class="tab-pane fade active in messages">
                            <table class="table table-striped table-advance table-hover web-mail" id="inbox-check">
                                <tbody>
                                    <tr data-messageid="" class="unread">
                                        <td class="inbox-small-cells">
                                            <div class="checker">
                                                <span>
                                                    <input type="checkbox" class="mail-checkbox">
                                                </span>
                                            </div>
                                        </td>
                                        <td class="inbox-small-cells">
                                            <i class="fa fa-star" aria-hidden="true"></i>
                                        </td>
                                        <td class="view-message hidden-xs">
                                            <a href="javascript:void(0);">
                                                <img src="https://scontent-sof1-1.xx.fbcdn.net/v/t1.0-9/10950663_325743464290451_5322829969991324771_n.jpg?oh=b95fffbe285df604f560c286e3d64ad8&oe=5976F312" class="img-circle" data-src="" alt="25x25" width="25px" height="25px">Ando IKM</a>
                                        </td>
                                        <td class="view-message ">
                                            <a href="javascript:void(0);">
                                                Fwd: Hay brother )
                                            </a>
                                        </td>
                                        <td class="view-message inbox-small-cells">
                                            <a href="javascript:void(0);">
                                                <i class="fa fa-paperclip"></i>
                                            </a>
                                        </td>
                                        <td class="view-message text-right">
                                            <a href="javascript:void(0);">16:30 AM</a>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div role="tabpanel" class="tab-pane changepassword" id="changepassword">
                        <div class="form-group">
                            <label class="col-xs-12 col-sm-3 text-right">Password <span>*</span></label>
                            <div class="input-group col-xs-12 col-sm-9">
                                <span class="input-group-addon" id="basic-addon2">
                                    <i class="fa fa-key" aria-hidden="true"></i>
                                </span>
                                <input type="password" class="form-control" placeholder="Password" aria-describedby="basic-addon2">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-xs-12 col-sm-3 text-right">Confirm Password <span>*</span></label>
                            <div class="input-group col-xs-12 col-sm-9">
                                <span class="input-group-addon" id="basic-addon3">
                                    <i class="fa fa-key" aria-hidden="true"></i>
                                </span>
                                <input type="password" class="form-control" placeholder="Password" aria-describedby="basic-addon3">
                            </div>
                        </div>
                        <div class="form-actions">
                            <div class="col-md-offset-3 col-md-9">
                                <input type="submit" class="btn btn-primary" value="Save">
                                <input type="reset" class="btn btn-default hidden-xs" value="Reset">
                            </div>
                        </div>
                    </div>
                    <div role="tabpanel" class="tab-pane" id="settings">Settings</div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
$this->registerJsFile(
        'https://maps.googleapis.com/maps/api/js?key=AIzaSyB69lYrWggKfgrW_XlsCojuMUyBoZ8bpk0&libraries=places&language=' . Yii::$app->language
);
$this->registerJsFile(
        '@web/js/profile.js', ['depends' => [\yii\web\JqueryAsset::className()]]
);
?>