<?php

$params = require __DIR__ . '/params.php';
$db = require __DIR__ . '/db.php';

$config = [
    'id' => 'basic',
    'language'=>'ru',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'defaultRoute' => 'calendar/index',
//    'catchAll' => ['site/about'],

    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
    'modules' => [
        'admin' => [
            'class' => 'app\modules\admin\Module',
            'layout' => 'main',
        ],
    ],
    'components' => [
        'sessionComponent'=>[
            'class'=>\app\components\SessionComponent::class,
        ],
        'messenger' => [
            'class' => \app\components\MessengerComponent::class,
        ],
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => 'KMOhr1QvSh880DrNpNETvXF409nXRpzG',
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
//        'cache' => [
//            'class' => \yii\caching\MemCache::class,
//            'useMemcached' => true,
//            'servers' => [
//                [
//                    'host' => '127.0.0.1',
//                    'port' => 11211,
//                    'persistent' => false,
//                ],
//            ],
//        ],
        'user' => [
            'identityClass' => 'app\models\User',
            'enableAutoLogin' => true,
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'authManager' => [
            'class' => \yii\rbac\DbManager::class,
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
        'db' => $db,
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
                '<action:(about|contact)>' => 'admin/default/<action>',
                '<action:(login|logout|signup)>' => 'site/<action>',
                '<controller:(catalog|activity|user)>/<id:\d+>/<action:(create|update|delete)>' => '<controller>/<action>',
                '<controller:(catalog|activity|user)>/<id:\d+>' => '<controller>/view',
                '<controller:(catalog|activity|user)>s' => '<controller>/index',
                'admin/<controller:(catalog|activity|user)>/<id:\d+>/<action:(create|update|delete)>' => 'admin/<controller>/<action>',
                'admin/<controller:(catalog|activity|user)>/<id:\d+>' => 'admin/<controller>/view',
                'admin/<controller:(catalog|activity|user)>s' => 'admin/<controller>/index',
                '/' => 'calendar/index',
            ],
        ],
    ],
    'params' => $params,
];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['bootstrap'][] = 'log';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        'allowedIPs' => ['*'],
    ];

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        'allowedIPs' => ['*'],
    ];
}

return $config;
