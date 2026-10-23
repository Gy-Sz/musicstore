<?php

namespace app\assets;

use yii\web\AssetBundle;

class TempusDominusAsset extends AssetBundle
{
    public $sourcePath = '@vendor/almasaeed2010/adminlte/plugins';

    public $css = [
        'tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css',
    ];

    public $js = [
        'moment/moment.min.js',
        'tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js',
    ];

    public $depends = [
        \hail812\adminlte3\assets\AdminLteAsset::class,
    ];
}
