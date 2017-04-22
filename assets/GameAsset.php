<?php

namespace app\assets;

use yii\web\AssetBundle;

class GameAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/game.css',
    ];
    public $js = [
        'js/map.js',
        'js/gameapi.js',
        'js/drawer.js',
        'js/game.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}
