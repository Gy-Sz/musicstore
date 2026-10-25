<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\OrderItem $model */
/** @var app\models\Order|null $order */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="order-item-form">

    <?php $form = ActiveForm::begin(); ?>

    <?php if ($order === null): ?>
        <?= $form->field($model, 'orderid')->textInput() ?>
    <?php else: ?>
        <p class="form-text"><?= Html::encode(Yii::t('app', 'Order ID: {id}', ['id' => $order->id])) ?></p>
        <?= $form->field($model, 'orderid')->hiddenInput()->label(false) ?>
    <?php endif; ?>

    <?= $form->field($model, 'productid')->textInput() ?>

    <?= $form->field($model, 'price_value')->textInput([
        'placeholder' => Yii::t('app', 'Leave blank for catalog price'),
    ]) ?>

    <?= $form->field($model, 'price_currency')->textInput([
        'maxlength' => true,
        'placeholder' => Yii::t('app', 'Leave blank for catalog price'),
    ]) ?>

    <?= $form->field($model, 'quantity')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
