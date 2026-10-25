<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var app\models\Price $model */
/** @var int|null $productId */

$this->title = $model->id;
$this->params['breadcrumbs'][] = $productId === null
    ? ['label' => Yii::t('app', 'Prices'), 'url' => ['index']]
    : ['label' => Yii::t('app', 'Prices for Product #{id}', ['id' => $productId]), 'url' => ['index', 'productId' => $productId]];
$this->params['breadcrumbs'][] = $this->title;
$updateRoute = ['update', 'id' => $model->id];
$deleteRoute = ['delete', 'id' => $model->id];
if ($productId !== null) {
    $updateRoute['productId'] = $productId;
    $deleteRoute['productId'] = $productId;
}
\yii\web\YiiAsset::register($this);
?>
<div class="price-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Update'), $updateRoute, ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Delete'), $deleteRoute, [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'productid',
            'value',
            'currency',
            'startdate',
            'enddate',
        ],
    ]) ?>

</div>
