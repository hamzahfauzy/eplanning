<?php

namespace eperencanaan\assets;

use yii\web\AssetBundle;

/**
 * Main eperencanaan application asset bundle.
 */
class DashboardAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
		'sb-admin/dist/css/sb-admin-2.css',
        'sb-admin/vendor/font-awesome/css/font-awesome.min.css',
        'sb-admin/vendor/metisMenu/metisMenu.min.css',
        'sb-admin/vendor/morrisjs/morris.css',
    ];
    public $js = [
        'js/plugins/modernizr/modernizr.js',   
        'js/plugins/bootstrap/bootstrap.min.js',
        'js/dev-loaders.js',
        'js/dev-layout-default.js',
        'js/dev-app.js',
		'sb-admin/js/sb-admin-2.js',
		//'sb-admin/vendor/jquery/jquery.min.js',
		'sb-admin/vendor/bootstrap/js/bootstrap.min.js',
		'sb-admin/dist/js/sb-admin-2.js',
		'sb-admin/vendor/metisMenu/metisMenu.min.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}
