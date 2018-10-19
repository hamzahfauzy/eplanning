<?php

namespace satuanharga\assets;

use yii\web\AssetBundle;

/**
 * Main satuanharga application asset bundle.
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
     //   'css/site.css',
    ];
    public $js = [
     
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}
