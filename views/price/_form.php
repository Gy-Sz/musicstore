<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\assets\TempusDominusAsset;

/** @var yii\web\View $this */
/** @var app\models\Price $model */
/** @var app\models\Product|null $product */
/** @var yii\widgets\ActiveForm $form */

$product = $product ?? null;
TempusDominusAsset::register($this);
$this->registerJs("$('#start-date-picker').datetimepicker({format: 'YYYY-MM-DD'});");
TempusDominusAsset::register($this);
$this->registerJs("$('#end-date-picker').datetimepicker({format: 'YYYY-MM-DD'});");
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

    <?= $form->field($model, 'startdate', [
        'template' => "{label}\n<div class=\"input-group date\" id=\"start-date-picker\" data-target-input=\"nearest\">{input}<div class=\"input-group-append\" data-target=\"#start-date-picker\" data-toggle=\"datetimepicker\"><div class=\"input-group-text\"><i class=\"fa fa-calendar\"></i></div></div></div>\n{error}\n{hint}",
    ])->textInput([
        'class' => 'form-control datetimepicker-input',
        'data-target' => '#start-date-picker',
    ]) ?>

    <?= $form->field($model, 'enddate', [
        'template' => "{label}\n<div class=\"input-group date\" id=\"end-date-picker\" data-target-input=\"nearest\">{input}<div class=\"input-group-append\" data-target=\"#end-date-picker\" data-toggle=\"datetimepicker\"><div class=\"input-group-text\"><i class=\"fa fa-calendar\"></i></div></div></div>\n{error}\n{hint}",
    ])->textInput([
        'class' => 'form-control datetimepicker-input',
        'data-target' => '#end-date-picker',
    ]) ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
