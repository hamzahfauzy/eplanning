<?php

namespace eperencanaan\assets;

use yii\web\AssetBundle;

/**
 * Main eperencanaan application asset bundle.
 */
class MapAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [];
    public $js = [
        '//maps.googleapis.com/maps/api/js?key=AIzaSyBnUKCKkjBBz0BGHF0PPlmBdSxKAhP93qc&callback=initMap',
        //'js/sistem/map_skrip.js',
    ];
    public $depends = [
    ];
    public $jsOptions = [
        'position' => \yii\web\View::POS_END,
        'async' => 'async',
        'defer' => 'defer',
    ];
}
