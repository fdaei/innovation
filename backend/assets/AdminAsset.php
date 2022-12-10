<?php

namespace backend\assets;

use yii\web\AssetBundle;

/**
 * Main backend application asset bundle.
 *
 * @author SADi <sadshafiei.01@gmail.com>
 */
class AdminAsset extends AssetBundle
{

    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $js = [
        'js/assets/libs/perfect-scrollbar/dist/perfect-scrollbar.jquery.min.js',
        'js/assets/libs/jquery.repeater/jquery.repeater.min.js',
        'js/assets/libs/sparkline/sparkline.js',
        'js/app.min.js',
        'js/base.js',
        'js/smooth-scroll.min.js',
        'js/app.init.mini-sidebar.js',
        'js/app-style-switcher.js',
        'js/waves.js',
        'js/sidebar-menu.js',
        'js/ajax-modal-popup.js',
        'js/toast.js',
        'js/jquery.double-keypress.js',
        'js/jquery.tags-input.js',
        // sweetalert2 JavaScript -->
        'js/sweetalert2.all.min.js',
        "js/horizontal-timeline.js",
    ];

    public $css = [
        'css/fonts/iranSansNumber/css/style.css',
        'css/fonts/font-awesome/css/all.min.css',
        //'css/bootstrap-4/bootstrap-rtl.css',
        //'css/table-responsive.css',
        'css/sweetalert2.min.css',
        "css/horizontal-timeline.css",
        "css/custom.css",
    ];

    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap4\BootstrapPluginAsset',
        'common\assetBundles\ClipboardAsset'
    ];
}