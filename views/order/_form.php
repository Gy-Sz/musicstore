<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\assets\Select2Asset;
use app\assets\TempusDominusAsset;

/** @var yii\web\View $this */
/** @var app\models\Order $model */
/** @var array $statusOptions */
/** @var array $customerOptions */
/** @var yii\widgets\ActiveForm $form */
Select2Asset::register($this);
$this->registerJs("$('#order-customerid').select2({theme: 'bootstrap4', width: '100%'});");
TempusDominusAsset::register($this);
$this->registerJs("$('#order-date-picker').datetimepicker({format: 'YYYY-MM-DD HH:mm:ss'});");
?>

<div class="order-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'datetime', [
        'template' => "{label}\n<div class=\"input-group date\" id=\"order-date-picker\" data-target-input=\"nearest\">{input}<div class=\"input-group-append\" data-target=\"#order-date-picker\" data-toggle=\"datetimepicker\"><div class=\"input-group-text\"><i class=\"fa fa-calendar\"></i></div></div></div>\n{error}\n{hint}",
    ])->textInput([
        'class' => 'form-control datetimepicker-input',
        'data-target' => '#order-date-picker',
    ]) ?>

    <?= $form->field($model, 'customerid', ['labelOptions' => ['label' => Yii::t('app', 'Customer')]])->dropDownList($customerOptions, [
        'prompt' => Yii::t('app', 'Select a customer'),
        'class' => 'form-control select2',
    ]) ?>

    <?= $form->field($model, 'statusid', ['labelOptions' => ['label' => Yii::t('app', 'Status')]])->dropDownList($statusOptions) ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
