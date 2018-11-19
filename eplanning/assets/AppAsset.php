<?php

namespace eplanning\assets;

use yii\web\AssetBundle;

/**
 * Main backend application asset bundle.
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
       'plugins/font-awesome/css/font-awesome.min.css',
        'plugins/simple-line-icons/simple-line-icons.min.css',
       'plugins/bootstrap-switch/css/bootstrap-switch.min.css',
       'admin/pages/css/timeline.css',
      'global/css/components.css',
       'global/css/plugins.css',
       'admin/layout/css/layout.css',
       'admin/layout/css/themes/darkblue.css',
       'admin/layout/css/custom.css',
        'plugins/select2/select2.css',

    ];
    public $js = [
   // 		'plugins/jquery-migrate.min.js',
   // 		'plugins/jquery-ui/jquery-ui.min.js',
   // 		'plugins/bootstrap/js/bootstrap.min.js',
   // 		'plugins/bootstrap-hover-dropdown/bootstrap-hover-dropdown.min.js',
   // 		'plugins/jquery-slimscroll/jquery.slimscroll.min.js',
   // 		'plugins/jquery.blockui.min.js',
   // 		'plugins/jquery.cokie.min.js',
   // 		'plugins/uniform/jquery.uniform.min.js',
    //		'plugins/bootstrap-switch/js/bootstrap-switch.min.js',
    //		'plugins/bootstrap-gtreetable/bootstrap-gtreetable.min.js',
   //         'plugins/select2/select2.min.js',
   //         'global/scripts/metronic.js',
   //         'admin/layout/scripts/layout.js',
    //        'admin/layout/scripts/quick-sidebar.js',
    //        'admin/layout/scripts/demo.js',
    //        //'admin/pages/scripts/timeline.js',
    //        'admin/pages/scripts/table-tree.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}
