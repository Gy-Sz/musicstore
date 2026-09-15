<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\ReleaseType $model */

$this->title = Yii::t('app', 'Create Release Type');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Release Types'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="release-type-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
