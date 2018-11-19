<?php

namespace frontend\assets;

use yii\web\AssetBundle;

/**
 * Main frontend application asset bundle.
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/theme.css',
        '//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css',
        '//fonts.googleapis.com/css?family=Open+Sans:400,300,600,700',
        '//fonts.googleapis.com/css?family=Roboto:300,400,500,700',
        '//fonts.googleapis.com/css?family=Droid+Serif:400,700,400italic,700italic'
    ];
    public $js = [
       // '//ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js',
        '//cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js',
        'http://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/js/bootstrap.min.js',
        'js/vendor/jqBootstrapValidation.js',
      //  'js/contact_me.js',
        'js/main.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}
