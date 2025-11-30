<?php

namespace backend\assets;

use yii\web\AssetBundle;

/**
 * Main backend application asset bundle.
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/site.css',
    ];
    public $js = [
        'js/dropzone.min.js',
    ];
    public $depends = [
        'yii\bootstrap5\BootstrapAsset',
        'yii\web\YiiAsset',
    ];
}
