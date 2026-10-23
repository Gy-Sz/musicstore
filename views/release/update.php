<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Release $model */
/** @var array $artists */
/** @var array $releaseTypes */

$this->title = Yii::t('app', 'Update Release: {name}', [
    'name' => $model->title,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Releases'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="release-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'artists' => $artists,
        'releaseTypes' => $releaseTypes,
    ]) ?>

</div>
