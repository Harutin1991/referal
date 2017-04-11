<?php
$params = array_merge(
    require(__DIR__ . '/../../common/config/params.php'),
    require(__DIR__ . '/../../common/config/params-local.php'),
    require(__DIR__ . '/params.php'),
    require(__DIR__ . '/params-local.php')
);

if(file_exists(__DIR__."/routes.json")){
    $rules = file_get_contents(__DIR__ . '/routes.json');
}else{
    $rules = [];
}
$Rules = json_decode($rules, true);
//'/<tag>'=>'product/sub-page', 'product/<id:\w+>'=>'product/index',   
//$routs = ['about'=>'site/about'];
//$routs = ['/news/<tag>'=>'news'];//,'page/service'=>'site/service','page/service/<tag>'=>'service/index','page-product/filter'=>'product/filter'];
//echo "<pre>";
//var_dump($routs, 1);
array_push($Rules, ['pattern'=>'/about','route'=>'site/about']);
array_push($Rules, ['pattern'=>'/contact','route'=>'site/contact']);
array_push($Rules, ['pattern'=>'/news/<tag>','route'=>'news']);
array_push($Rules, ['pattern'=>'/events/<tag>','route'=>'events']);
array_push($Rules, ['pattern'=>'page/news','route'=>'site/news']);
array_push($Rules, ['pattern'=>'page/materials','route'=>'site/materials']);
array_push($Rules, ['pattern'=>'page/materials/<tag>','route'=>'materials/index']);
array_push($Rules, ['pattern'=>'page/brands','route'=>'site/brands']);
array_push($Rules, ['pattern'=>'page/brands/<id:\d+>','route'=>'brands/index']);
array_push($Rules, ['pattern'=>'page/events','route'=>'site/events']);
array_push($Rules, ['pattern'=>'page/works','route'=>'site/works']);
array_push($Rules, ['pattern'=>'page/works/<tag>','route'=>'works/index']);
array_push($Rules, ['pattern'=>'page/service','route'=>'site/service']);
array_push($Rules, ['pattern'=>'page/service/<tag>','route'=>'service/index']);
array_push($Rules, ['pattern'=>'page-product/filter','route'=>'product/filter']);
array_push($Rules, ['pattern'=>'product/<tag>','route'=>'product/sub-page']);
array_push($Rules, ['pattern'=>'product/best-seller','route'=>'product/best-seller']);


//$Rules = array_merge_recursive($Rules,['/site/page/<tag>'=>'/site/page']);

$db = array_merge(require(__DIR__ . '/../../common/config/db-local.php'));
return [
    'id' => 'app-frontend',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'controllerNamespace' => 'frontend\controllers',
    'components' => [
        'db' => $db,
        'request' => [
            'csrfParam' => '_csrf-frontend',
            'cookieValidationKey' => '!SomeRandomString@',
            'enableCookieValidation'=>true,
        ],
        'user' => [
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => true,
            'identityCookie' => ['name' => '_identity-frontend', 'httpOnly' => true],
        ],
        'session' => [
            // this is the name of the session cookie used for login on the frontend
            'name' => 'advanced-frontend',
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'language' => 'am',
        'sourceLanguage' => 'am',
        'i18n' => [
            'translations' => [
                'app*' => [
                    'class' => 'yii\i18n\DbMessageSource',
                ],
            ],
        ],
        'urlManager' => [
            'class' => 'codemix\localeurls\UrlManager',
            'languages' => ['ru','en'],
            'enableDefaultLanguageUrlCode' => false,
            'enableLanguagePersistence' => false,
            'showScriptName' => false,
            'rules' => $Rules,
            
        ],
        'cart' => [
            'class' => 'yz\shoppingcart\ShoppingCart',
        ],
    ],
    'params' => $params,
];
