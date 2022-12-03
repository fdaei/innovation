<?php

namespace backend\assets;

use yii\web\AssetBundle;

/**
 * Main backend application Login asset bundle.
 */
class LoginAsset extends AssetBundle {

    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $js = [
        'js/assets/libs/perfect-scrollbar/dist/perfect-scrollbar.jquery.min.js',
        'js/assets/libs/sparkline/sparkline.js',
        'js/app.min.js',
        'js/base.js',
        // sweetalert2 JavaScript -->
        'js/sweetalert2.all.min.js',
        'js/owl.carousel.min.js'
    ];

    public $css = [
        'css/fonts/iranSansNumber/css/style.css',
        'css/fonts/font-awesome/css/all.min.css',
        'css/style.css',
        'css/sweetalert2.min.css',
        'css/owl.carousel.min.css'
    ];

    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap4\BootstrapPluginAsset',
    ];
}