<?php
$params = array_merge(
    require(__DIR__ . '/../../common/config/params.php'),
    require(__DIR__ . '/../../common/config/params-local.php'),
    require(__DIR__ . '/params.php'),
    require(__DIR__ . '/params-local.php')
);

return [
    'id' => 'app-eplanning',
    'basePath' => dirname(__DIR__),
    'controllerNamespace' => 'eplanning\controllers',
    'bootstrap' => ['log'],
    'modules' => [],
    'defaultRoute' => 'site/index',
    'components' => [
        'request' => [
            'csrfParam' => '_csrf-eplanning',
        ],
        'user' => [
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => true,
            'identityCookie' => ['name' => '_identity-eplanning', 'httpOnly' => true],
        ],
        'session' => [
            // this is the name of the session cookie used for login on the eplanning
            'name' => 'advanced-eplanning',
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
        /*
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
            ],
        ],
        */
    ],
    'params' => $params,
];
