<?php

return [
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
	'timeZone' => 'Asia/Jakarta',
    'language' => 'id-ID',
    'modules' => [
        'gridview' => [
            'class' => '\kartik\grid\Module'
        ]
    ],
    'components' => [
        // 'cache' => [  
        //    'class' => 'yii\caching\FileCache',
        // ],
        'levelcomponent' => [

            'class' => 'common\components\LevelComponent',
        ],
        'authManager' => [
            'class' => 'yii\rbac\DbManager',
            'defaultRoles' => ['guest'],
        ],
        'zultanggal' => [
            'class' => 'common\components\ZULTanggal',
        ],
        'pengaturan' => [

            'class' => 'common\components\Pengaturan',
        ],

        'configcomponent' => [

            'class' => 'common\components\ConfigComponent',
        ],
    ],
    'as access' => [
        'class' => 'mdm\admin\components\AccessControl',
        'allowActions' => [
            // '*', 
            'dashboard/*',
            'site/*',
            // 'admin/*',
            // 'gii/*',
            //'debug/*',
            'ajax/*',
            'pra-rka-prov/kirim-data',
            'api/*',
            'monitoring/*',
        ]
    ],
    'params' => [
    'maskMoneyOptions' => [
        'prefix' => '',
        'suffix' => '',
        'affixesStay' => true,
        'thousands' => '.',
        'decimal' => ',',
        'precision' => 2, 
        'allowZero' => false,
        'allowNegative' => false,
    ]
],
];

