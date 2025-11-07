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
        'css/main.css',
        'css/site.css',
        'css/bootstrap.min.css',
        'css/glightbox.min.css',
        'css/LineIcons.3.0.css',
        'css/tiny-slider.css',
        'css/animate.css',
    ];
    public $js = [
        'js/bootstrap.min.js',
        'js/count-up.min.js',
        'js/glightbox.min.js',
        'js/imagesloaded.min.js',
        'js/isotope.min.js',
        'js/main.js',
        'js/tiny-slider.js',
        'js/wow.min.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap5\BootstrapAsset',
    ];
}
