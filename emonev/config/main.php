<?php

$params = array_merge(
        require(__DIR__ . '/../../common/config/params.php'), 
        require(__DIR__ . '/../../common/config/params-local.php'), 
        require(__DIR__ . '/params.php')
        //  require(__DIR__ . '/params-local.php')
);

return [
    'id' => 'app-emonev',
    'basePath' => dirname(__DIR__),
    'name' => 'e-Monev Kab. Asahan',
    'controllerNamespace' => 'emonev\controllers',
    'bootstrap' => ['log'],
    'modules' => [],
    'components' => [
        'assetManager' => [
            'bundles' => [
                'dmstr\web\AdminLteAsset' => [
                    'skin' => 'skin-green',
                /**
                  "skin-blue",
                  "skin-black",
                  "skin-red",
                  "skin-yellow",
                  "skin-purple",
                  "skin-green",
                  "skin-blue-light",
                  "skin-black-light",
                  "skin-red-light",
                  "skin-yellow-light",
                  "skin-purple-light",
                  "skin-green-light"
                 */
                ],
            ],
        ],
        'view' => [
            'theme' => [
                'basePath' => '@emonev/themes/yii2-app',
                'baseUrl' => '@web/themes/yii2-app',
                'pathMap' => [
                    '@emonev/views' => '@emonev/themes/yii2-app',
                ],
            ],
        ],
        'request' => [
            'csrfParam' => '_csrf-emonev',
        ],
        'user' => [
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => true,
            'identityCookie' => ['name' => '_identity-emonev', 'httpOnly' => true],
            'loginUrl' => [ 'site/login' ],
        ],
        'authManager' => [
            'class' => 'yii\rbac\DbManager',
            'defaultRoles' => ['guest'],
        ],
        'session' => [
            // this is the name of the session cookie used for login on the emusrenbang
            'name' => 'advanced-emonev',
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
    'modules' => [
        'admin' => [
            'class' => 'mdm\admin\Module',
            //'layout' => 'left-menu',
            'mainLayout' => '@emonev/views/layouts/main.php',
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
            //'*',
            //'site/*',
            //'admin/*',
            'gii/*',
            'debug/*',
            'ajax/*',
            'rpjmd/*',
            'laporan-bappeda/*',
            'laporan-pra-rka/*'
        ]
    ],
];
