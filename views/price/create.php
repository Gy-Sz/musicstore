<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Price $model */
/** @var app\models\Product|null $product */

$product = $product ?? null;
$this->title = Yii::t('app', 'Create Price');
$this->params['breadcrumbs'][] = $product === null
    ? ['label' => Yii::t('app', 'Prices'), 'url' => ['index']]
    : ['label' => Yii::t('app', 'Prices for Product #{id}', ['id' => $product->id]), 'url' => ['index', 'productId' => $product->id]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="price-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'product' => $product,
    ]) ?>

</div>
