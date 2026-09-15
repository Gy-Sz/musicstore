<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Artist $model */

$this->title = Yii::t('app', 'Create Artist');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Artists'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="artist-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
