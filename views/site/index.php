<?php

use yii\helpers\Html;

$this->title = Yii::$app->name;
?>
<div class="site-index">
    <div class="d-flex gap-3 flex-wrap">
        <?= Html::a(
            Yii::t('app', 'Create Order'),
            ['/order/create'],
            ['class' => 'btn btn-success btn-lg'],
        ) ?>
        <?= Html::a(
            Yii::t('app', 'Create Release'),
            ['/release/create'],
            ['class' => 'btn btn-success btn-lg'],
        ) ?>
    </div>
</div>
