<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\OrderStatus $model */

$this->title = Yii::t('app', 'Create Order Status');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Order Statuses'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="order-status-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
