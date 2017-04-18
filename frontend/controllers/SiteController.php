<?php

namespace frontend\controllers;

use Yii;
use yii\base\InvalidParamException;
use yii\helpers\Url;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\LoginForm;
use frontend\models\PasswordResetRequestForm;
use frontend\models\ResetPasswordForm;
use frontend\models\Pages;
use common\models\User;
use common\models\Language;
use backend\models\Faq;
use backend\models\Aboutus;


/**
 * Site controller
 */
class SiteController extends Controller {

    /**
     * @inheritdoc
     */
    public function behaviors() {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['get'],
                ],
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function actions() {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
            'auth' => [
                'class' => 'yii\authclient\AuthAction',
                'successCallback' => [$this, 'successCallback'],
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return mixed
     */
    public function actionIndex() {
        return $this->render('index');
    }

    public function actionNews() {
        $news = News::findList();
        return $this->render('news', ['news' => $news]);
    }

    public function actionWorks() {
        $this->layout = "secondLayout";
        $works = Works::findList();
        return $this->render('works', ['works' => $works]);
    }

    public function actionEvents() {
        $this->layout = "secondLayout";
        $events = Events::findList();
        return $this->render('events', ['events' => $events]);
    }

    public function actionService() {
        $service = Service::findList();
        return $this->render('service', ['service' => $service]);
    }

    public function actionChangeCurrency($currency) {
        $currency = Currency::find()->where(['id' => $currency])->one();
        $session = Yii::$app->session;
        if (!empty($currency)) {
            $currencySession = ['currenncyID' => $currency->id, 'exchange' => $currency->exchange_value];
            if ($session->has('currency')) {
                $currncyArray = $session->remove('currency');
            }
            $session->set('currency', $currencySession);
        }
        return $this->redirect(Yii::$app->request->referrer);
    }

    /**
     * Logs in a user.
     *
     * @return mixed
     */
    public function actionLogin($authkey = null) {
        if (!Yii::$app->user->isGuest) {
            return $this->goBack();
        }

        $model = new LoginForm();
        $modelSignup = new SignupForm();
        if (!is_null($authkey)) {
            $customer = Customer::findByPasswordResetToken($authkey);
            if ($customer) {
                $modelSignup->name = $customer->name;
                $modelSignup->surname = $customer->surname;
                $modelSignup->email = $customer->email;
                $modelSignup->name = $customer->name;
                $modelSignup->verifyToken = $authkey;
                Yii::$app->session->setFlash('notvalid', 'You have successfuly verified your email!');
                Yii::$app->session->setFlash('notvalid', 'Please type new password on Signup form to alow to enter your account');
            } else {
                Yii::$app->session->setFlash('error', 'Wrong password reset token.');
            }
        }

        if ($model->load(Yii::$app->request->post())) {
            $email = Yii::$app->request->post('LoginForm')['email'];
            if ($model->login()) {
                return $this->redirect(Url::previous());
            } elseif (User::$notverified) {
                Yii::$app->session->setFlash('notvalid', 'Please enter your email acocunt and verify your email');
                $model->sendEmailVerify($email);
                return $this->redirect('/site/login');
            } else {
                Yii::$app->session->setFlash('error', 'You typed not correct email or password');
                return $this->redirect('/site/login');
            }
        } else {
            return $this->render('login', [
                        'model' => $model,
                        'modelSignup' => $modelSignup,
            ]);
        }
    }

    /**
     * @param $client
     */
    public function successCallback($client) {

        $social = '';
        if ($client->authUrl == 'https://www.facebook.com/dialog/oauth') {
            $attributes = $client->getUserAttributes();
            $social = 'facebook';
        }

        if ($client->authUrl == 'https://accounts.google.com/o/oauth2/auth') {
            $client->apiBaseUrl = 'https://www.googleapis.com/oauth2/v1';
            $attributes = $client->api('me', 'GET');
            $social = 'google';
            echo "<pre>";
            print_r($attributes);
            die;
        }

        if (isset($attributes['email'])) {
            $user = Customer::find()->where(['email' => $attributes['email']])->one();
            if (Customer::find()->where(['email' => $attributes['email']])->exists()) {
                $userLogin = User::find()->where(['id' => $user->user_id])->one();
                if (!empty($userLogin)) {
                    Yii::$app->user->login($userLogin);
                }
            } else {
                // Save session attribute user from FB
                $session = Yii::$app->session;
                $session['attributes'] = $attributes;
                if (!empty($session['attributes'])) {
                    if ($social == 'facebook') {
                        $user = new User();
                        $user->username = str_replace(' ', '_', $session['attributes']['name']);
                        $user->role = 20;
                        $password = Yii::$app->security->generateRandomString(6);
                        $user->setPassword($password);
                        $user->generateAuthKey();
                        if ($user->save()) {
                            $customer = new Customer();
                            $user_fio = explode(' ', $session['attributes']['name']);
                            $customer->name = $user_fio[0];
                            $customer->surname = $user_fio[1];
                            $customer->email = $session['attributes']['email'];
                            $customer->user_id = $user->id;
                            $customer->last_ip = \Yii::$app->request->userIP;
                            $customer->status = 0;
                            if (isset($session['attributes']['username'])) {
                                $customer->social_user_name = $session['attributes']['name'];
                            } else {
                                $customer->social_user_name = '';
                            }
                            $customer->auth_token = '';
                            if ($customer->save(false)) {
                                $userData = ['email' => $customer->email, 'password' => $password];
                                if ($this->sendEmail($customer->email, 'Invite', $userData)) {
                                    Yii::$app->session->setFlash('success', "Your login data sent to your email, please enter to your email to see");
                                }
                            }
                        }
                    } elseif ($social == 'google') {
                        
                    }
                }
            }
        } else {
            Yii::$app->session->setFlash('error', 'Invalid Email.');
        }
    }

    public function sendEmail($to, $subject, $data) {
        $username = ucfirst($data['email']);
        $password = $data['password'];
        $name = preg_replace("/[0-9]+/", '', $username);
        $message = "Hello $name!<br/><br/>
        Your username is $username,<br/>
             password is $password<br/>
         You was added as Customer in our site. You'll love it!";
        return Yii::$app
                        ->mailer
                        ->compose('email-layout', ['content' => $message])
                        ->setFrom(['admin-odenson@test.com' => Yii::$app->name])
                        ->setTo($to)
                        ->setSubject($subject)
                        ->send();
    }

    public function actionCart() {
        return $this->render('/cart/list');
    }

    /**
     * Logs out the current user.
     *
     * @return mixed
     */
    public function actionLogout() {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return mixed
     */
    public function actionContact() {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail('narek.amirkhanyan92@gmail.com')) {
                Yii::$app->session->setFlash('success', 'Thank you for contacting us. We will respond to you as soon as possible.');
            } else {
                Yii::$app->session->setFlash('error', 'There was an error sending email.');
            }

            return $this->refresh();
        } else {
            return $this->render('contact', [
                        'model' => $model,
            ]);
        }
    }

    public function actionAbout() {
        $about = Aboutus::find_One();
        return $this->render('about', ['page' => $about]);
    }

    /**
     * Displays about page.
     *
     * @return mixed
     */
    public function actionPage($id) {
        $page = Pages::findList($id);
        return $this->render('page', ['page' => $page]);
    }

    /**
     * Displays faq page.
     *
     * @return mixed
     */
    public function actionFaq() {
        $faq = Faq::findList();
        return $this->render('/faq/faq',['faq'=>$faq]);
    }
    
    /**
     * Displays faq page.
     *
     * @return mixed
     */
    public function actionBlog() {
        return $this->render('/blog/index');
    }

    /**
     * Signs user up.
     *
     * @return mixed
     */
    public function actionSignup() {
        $model = new SignupForm();
        if (Yii::$app->request->post()) {
            $verifyToken = Yii::$app->request->post('verifyToken');
            $customer = Customer::findByPasswordResetToken($verifyToken);
            $model->load(Yii::$app->request->post());
            $model->username = $model->name . time();
            ;
            if ($customer) {
                $customer->auth_token = "";
                if ($customer->save()) {
                    $user = $model->getNewUser();
                    if (Yii::$app->getUser()->login($user)) {
                        Yii::$app->session->setFlash('success', 'You should type your contact info');
                        return $this->redirect('/user/profile');
                    }
                }
            } else {
                if ($user = $model->signup()) {
                    if (Yii::$app->getUser()->login($user)) {
                        Yii::$app->session->setFlash('success', 'You should type your contact info');
                        return $this->redirect('/user/profile');
                    }
                }
            }
        }
        $modelLogin = new LoginForm();
        return $this->render('login', [
                    'model' => $modelLogin,
                    'modelSignup' => $model,
        ]);
    }

    /**
     * Requests password reset.
     *
     * @return mixed
     */
    public function actionRequestPasswordReset() {
        $model = new PasswordResetRequestForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail()) {
                Yii::$app->session->setFlash('success', 'Check your email for further instructions.');

                return $this->goHome();
            } else {
                Yii::$app->session->setFlash('error', 'Sorry, we are unable to reset password for email provided.');
            }
        }

        return $this->render('requestPasswordResetToken', [
                    'model' => $model,
        ]);
    }

    /**
     * Resets password.
     *
     * @param string $token
     * @return mixed
     * @throws BadRequestHttpException
     */
    public function actionResetPassword($token) {
        try {
            $model = new ResetPasswordForm($token);
        } catch (InvalidParamException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }

        if ($model->load(Yii::$app->request->post()) && $model->validate() && $model->resetPassword()) {
            Yii::$app->session->setFlash('success', 'New password was saved.');

            return $this->goHome();
        }

        return $this->render('resetPassword', [
                    'model' => $model,
        ]);
    }

}
