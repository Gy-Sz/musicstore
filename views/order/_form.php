<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\assets\TempusDominusAsset;

/** @var yii\web\View $this */
/** @var app\models\Order $model */
/** @var array $statusOptions */
/** @var yii\widgets\ActiveForm $form */
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

    <?= $form->field($model, 'customerid')->textInput() ?>

    <?= $form->field($model, 'statusid')->dropDownList($statusOptions) ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
