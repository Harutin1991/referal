<?php

use yii\helpers\Html;
use kartik\growl\Growl;

/* @var $this yii\web\View */
/* @var $UserModel common\models\CustomerAddress */
/* @var $favorites common\models\Product[] */
?>

<?php if (Yii::$app->user->identity->role == 20): ?>
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
<section id="account">
    <div class="container">
        <div class="row box account-content">
            <div class="col-sm-12">
                <div class="row">
                    <div class="col-sm-12 account-head">
                        <h1>Account Information</h1>
                    </div>
                </div>
                <div class="row account-body">
                    <div class="col-sm-6 bx-info contact-box">
                        <h3>Contact informations</h3>
                        <br>
                        <ul>
                            <li class="info-row">First Name <span
                                    data-name="name"><?= ucfirst($UserModel->name); ?></span><i
                                    class="material-icons edit">create</i></li>
                            <li class="info-row">Last Name <span
                                    data-name="surname"><?= ucfirst($UserModel->surname); ?></span><i
                                    class="material-icons edit">create</i></li>
                            <li class="info-row">Phone Number <span
                                    data-name="phone"><?php echo $UserModel->phone ? $UserModel->phone : "<span class='unverfy'><i class=\"material-icons\">&#xE001;</i>not verifyed</span>"; ?></span><i
                                    class="material-icons edit">create</i></li>
                            <li class="info-row">Mobile Number <span
                                    data-name="phone"><?php echo $UserModel->phone ? $UserModel->phone : "<span class='unverfy'><i class=\"material-icons\">&#xE001;</i>not verifyed</span>"; ?></span><i
                                    class="material-icons edit">create</i></li>
                            <li class="info-row">Email <span data-name="email"><?= $UserModel->email; ?></span><i
                                    class="material-icons edit">create</i></li>
                            <input id="user_id" type="hidden" value="<?= ucfirst($UserModel->id); ?>">
                        </ul>
                    </div>
                    <div class="col-sm-6 bx-info shipping-box">

                        <?php echo $addressForm; ?>
                    </div>
                </div>
                <div class="row" id="account_tab">
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
                                'content' => $this->render('favorites',['products'=>$favorites]),
                                'headerOptions' => [''],
                                'options' => ['id' => 'myveryownID'],
                            ],
                        ],
                    ]);
                    ?>
                    
                </div>
            </div>
        </div>
    </div>
</section>
