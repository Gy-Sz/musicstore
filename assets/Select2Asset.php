<?php

namespace app\assets;

use yii\web\AssetBundle;

class Select2Asset extends AssetBundle
{
    public $sourcePath = '@vendor/almasaeed2010/adminlte/plugins';

    public $css = [
        'select2/css/select2.min.css',
        'select2-bootstrap4-theme/select2-bootstrap4.min.css',
    ];

    public $js = [
        'select2/js/select2.full.min.js',
    ];

    public $depends = [
        \hail812\adminlte3\assets\AdminLteAsset::class,
    ];
}
