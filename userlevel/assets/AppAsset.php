<?php

namespace userlevel\assets;

use yii\web\AssetBundle;

/**
 * Main userlevel application asset bundle.
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        //'css/site.css',
       // 'css/font-awesome.css',
       // 'css/bootstrap.css',
        'css/layout.css',
        'css/components.css',
    ];
    public $js = [
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}
