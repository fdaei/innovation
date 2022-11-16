<?php

namespace common\assetBundles;

use yii\web\AssetBundle;

/**
 * ValidationAsset AssetBundle for validate that the attribute value is a national code.
 *
 * @author SADi <sadshafiei.01@gmail.com>
 */
class RunwidgetValidationAsset extends AssetBundle
{
    public $sourcePath = '@common/assets/validator';
    public $js = [
        'js/runwidget.validation.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
    ];
}