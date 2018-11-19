<?php
$params = array_merge(
    require(__DIR__ . '/../../common/config/params.php'),
    require(__DIR__ . '/../../common/config/params-local.php'),
    require(__DIR__ . '/params.php'),
    require(__DIR__ . '/params-local.php')
);

return [
    'id' => 'app-referensi',
    'name'=>'App Referensi',
    'basePath' => dirname(__DIR__),
    'controllerNamespace' => 'referensi\controllers',
    'bootstrap' => ['log'],
    'modules' => [],
    'components' => [
        'assetManager' => [
            'bundles' => [
                'dmstr\web\AdminLteAsset' => [
                    'skin' => 'skin-yellow',
                ],
            ],
        ],
        'request' => [
            'csrfParam' => '_csrf-referensi',
        ],
        'user' => [
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => true,
            'identityCookie' => ['name' => '_identity-referensi', 'httpOnly' => true],
        ],
        'session' => [
            // this is the name of the session cookie used for login on the referensi
            'name' => 'advanced-referensi',
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
    'defaultRoute' => 'site/index',
    
    'modules' => [
        'admin' => [
            'class' => 'mdm\admin\Module',
           // 'layout' => 'left-menu',
            'mainLayout' => '@referensi/views/layouts/main.php',
            'controllerMap' => [
            'assignment' => [
                'class' => 'mdm\admin\controllers\AssignmentController',
                'userClassName' => 'common\models\User',
                'idField' => 'id'
            ],
        ],
        ]
    ],
    'as access' => [
        'class' => 'mdm\admin\components\AccessControl',
        'allowActions' => [
           // '*',
            'site/*',
          //  'admin/*',
            'gii/*',
            'debug/*',
          //  'dodol/*'
        ]
    ],
];
