<?php

namespace eperencanaan\assets;

use yii\web\AssetBundle;

/**
 * Main eperencanaan application asset bundle.
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/style.css',
    ];
    public $js = [
	   
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
 //   public $jsOptions = [
 //       'position' => \yii\web\View::POS_HEAD
 //   ];
}
