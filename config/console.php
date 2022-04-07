<?php
$params = require __DIR__ . '/params.php';
$db = require __DIR__ . '/db.php';

$config = [
    'id'         => 'basic',
    'basePath'   => dirname(__DIR__),
    'bootstrap' => ['log', 'constant'],

    'components' => [
        'constant' => [
            'class' => 'app\components\Constant',
        ],
        'debug' => [
            'class' => 'app\components\Debug',
        ],
		'request' => [

			'enableCsrfValidation' => true
		],

        'urlManager' => [
            'class'           => 'yii\web\UrlManager',
            'showScriptName'  => false,
            'enablePrettyUrl' => true,
            'rules'           => [
                '<controller:\w+>/<id:\d+>'              => '<controller>/view',
                '<controller:\w+>/<action:\w+>/<id:\d+>' => '<controller>/<action>',
                '<controller:\w+>/<action:\w+>'          => '<controller>/<action>',
                "Login"                                  => "admin/login",
                "Dashboard"                              => "site/user-loggedin-home-page",
                'baseUrl'                                => '/',
                "Logout"                                 => "site/logout",
                
            ],
        ],
        'cache'      => [
            'class' => 'yii\caching\FileCache',
        ],

        // database connections
        'db' => [
            'class' => 'yii\db\Connection',
            'dsn' => 'mysql:host=localhost;dbname=mirzasaf_rotitime',
            'username' => 'root',
            'password' => 'Apple!@#456',
            'charset' => 'utf8',
        ],

        'rotitime' => [
            'class' => 'yii\db\Connection',
            'dsn' => 'mysql:host=localhost;dbname=mirzasaf_rotitime',
            'username' => 'root',
            'password' => 'Apple!@#456',
            'charset' => 'utf8',
        ],

        'mailer'     => [
            'class'            => 'yii\swiftmailer\Mailer',
            // send all mails to a file by default. You have to set
            // 'useFileTransport' to false and configure a transport
            // for the mailer to send real emails.
            'useFileTransport' => true,
        ],
        'log'        => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets'    => [
                [
                    'class'  => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],


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
];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][]      = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
    ];

    $config['bootstrap'][]    = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
    ];
}

return $config;


/*$params = require __DIR__ . '/params.php';
$db = require __DIR__ . '/db.php';

$config = [
    'id' => 'basic-console',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'controllerNamespace' => 'app\commands',
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
        '@tests' => '@app/tests',
    ],
    'components' => [
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'log' => [
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'db' => $db,
    ],
    'params' => $params,
    /*
    'controllerMap' => [
        'fixture' => [ // Fixture generation command line.
            'class' => 'yii\faker\FixtureController',
        ],
    ],
    */
/*];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
    ];
}*/

//return $config;
