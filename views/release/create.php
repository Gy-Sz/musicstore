<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Release $model */
/** @var array $artists */
/** @var array $releaseTypes */

$this->title = Yii::t('app', 'Create Release');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Releases'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="release-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'artists' => $artists,
        'releaseTypes' => $releaseTypes,
    ]) ?>

</div>
