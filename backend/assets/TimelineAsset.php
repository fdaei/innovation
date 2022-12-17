<?php
namespace backend\assets;
use yii\web\AssetBundle;
class TimelineAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [

    ];
    public $js = [
        "js/horizontal-timeline.js",
    ];
    public $depends = [
    ];
}