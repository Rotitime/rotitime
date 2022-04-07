<?php
use \yii\web\Request;
use app\models\User;

$params = require __DIR__ . '/params.php';
$db = require __DIR__ . '/db.php';

$baseUrl = str_replace('/web', '', (new Request)->getBaseUrl());

$config = [
    'id' => 'basic',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log','constant'
	//'app\components\DynaRoute',
	],
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],

	 

    'components' => [
	
	
		'constant'            => [
            'class' => 'app\components\Constant',
        ],
        'debug'               => [
            'class' => 'app\components\Debug',
        ],

        'authClientCollection' => [
            'class' => 'yii\authclient\Collection',
            'clients' => [
                'google' => [
                    'class' => 'yii\authclient\clients\GoogleOAuth',
                    'clientId' => '712694426839-0mprkf9l7ee1oik6ucjq0eh858dbtgt6.apps.googleusercontent.com',
                    'clientSecret' => 'XuAHe9yO34jju8ODSFZZ9EBj',
                ],
            ],
        ],

	
	 'urlManager'          => [
		'class'           => 'yii\web\UrlManager',
		'showScriptName'  => false,
		'enablePrettyUrl' => true,
//            'suffix'=>'.html',
		'rules'           => [
            '<alias:index|about|contact>' => 'site/<alias>', 
            '<alias>' => 'site/restaurant-details',
            //'<alias>' => 'site/cms-page',
			'confirmation/<alias>' => 'site/confirmation',
			'<controller:\w+>/<id:\d+>'              => '<controller>/view',
			'<controller:\w+>/<action:\w+>/<id:\d+>' => '<controller>/<action>',
			'<controller:\w+>/<action:\w+>'          => '<controller>/<action>',
			"Login"                                  => "admin/login",
			"UnSubscribeEmail"                       => "site/un-subscribe-email",
			"Dashboard"                              => "site/user-loggedin-home-page",
			'baseUrl'                                => '/',
			"Logout"                                 => "site/logout",
		],
	],
	'request' => [
		// !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
		'cookieValidationKey' => 'RotiTimeKeys',
		'baseUrl'              => $baseUrl,
		'enableCsrfValidation' => true,
	],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'user' => [
            'identityClass' => 'app\models\User',
            'enableAutoLogin' => true,
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            // send all mails to a file by default. You have to set
            // 'useFileTransport' to false and configure a transport
            // for the mailer to send real emails.
            'useFileTransport' => true,
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
        // database connections
        'db' => [
            'class' => 'yii\db\Connection',
            'dsn' => 'mysql:host=localhost;dbname= mirzasaf_rotitime',
            'username' => 'root',
            'password' => 'Welcome!@#456',
            'charset' => 'utf8',
        ],

        'rotitime' => [
            'class' => 'yii\db\Connection',
            'dsn' => 'mysql:host=localhost;dbname=mirzasaf_rotitime',
            'username' => 'root',
            'password' => 'Welcome!@#456',
            'charset' => 'utf8',
        ],
        /*
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
            ],
        ],
        */

	'cart' => [
    'class' => 'devanych\cart\Cart',
    'storageClass' => 'devanych\cart\storage\SessionStorage',
    'calculatorClass' => 'devanych\cart\calculators\SimpleCalculator',
    'params' => [
        'key' => 'cart',
        'expire' => 604800,
        'productClass' => 'app\model\RtRestaurantDishes',
        'productFieldId' => 'dish_id',
        'productFieldPrice' => 'dish_price',
    ],
],

    ],
    'params' => $params,
	'on beforeAction' => function ($event) {
        //Login Checking
     $controllerName = Yii::$app->controller->id;
	 $actionName = Yii::$app->controller->action->id; 
	 if($controllerName == 'as' || $controllerName == 'am' || $controllerName == 'reports' || $controllerName == 'admin' || $controllerName == 'ra') {
		 $Users = new User();
         $LoggedUserId = $Users->GetLoginUserId();
		 if(empty($LoggedUserId)) {
			header('Location: '.SITE_URL);
		 }
	 }
	},
];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        //'allowedIPs' => ['127.0.0.1', '::1'],
    ];

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        //'allowedIPs' => ['127.0.0.1', '::1'],
    ];
}

return $config;
