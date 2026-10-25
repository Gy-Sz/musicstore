<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Price $model */
/** @var app\models\Product|null $product */
/** @var yii\widgets\ActiveForm $form */

$product = $product ?? null;
?>

<div class="price-form">

    <?php $form = ActiveForm::begin(); ?>

    <?php if ($product === null): ?>
        <?= $form->field($model, 'productid')->textInput() ?>
    <?php else: ?>
        <p class="form-text"><?= Html::encode(Yii::t('app', 'Product ID: {id}', ['id' => $product->id])) ?></p>
        <?= $form->field($model, 'productid')->hiddenInput()->label(false) ?>
    <?php endif; ?>

    <?= $form->field($model, 'value')->textInput() ?>

    <?= $form->field($model, 'currency')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'startdate')->textInput() ?>

    <?= $form->field($model, 'enddate')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
