<?php

namespace backend\assets;

use yii\web\AssetBundle;

/**
 * Main backend application asset bundle.
 */
class LoginAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/bootstrap.min.css',
        'css/site.css',
        'css/styles.css',
        'css/bootstrap-responsive.css',
        'css/bootstrap.min.css',
        'css/font-awesome.min.css',
        'css/ionicons.min.css',
        'css/AdminLTE.min.css',
        'css/blue.css',
        
    ];

    public $js = [
        'js/jquery-ui.min.js',
        'js/bootstrap.min.js',
    ];
    
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
         'yii\bootstrap\BootstrapPluginAsset',
    ];
}
