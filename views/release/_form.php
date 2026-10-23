<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\assets\Select2Asset;
use app\assets\TempusDominusAsset;

/** @var yii\web\View $this */
/** @var app\models\Release $model */
/** @var array $artists */
/** @var array $releaseTypes */
/** @var yii\widgets\ActiveForm $form */

Select2Asset::register($this);
$this->registerJs("$('#release-artistid').select2({theme: 'bootstrap4', width: '100%'});");
TempusDominusAsset::register($this);
$this->registerJs("$('#release-date-picker').datetimepicker({format: 'YYYY-MM-DD'});");
?>

<div class="release-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'artistid', ['labelOptions' => ['label' => Yii::t('app', 'Artist')]])->dropDownList($artists, [
        'prompt' => Yii::t('app', 'Select an artist'),
        'class' => 'form-control select2',
    ]) ?>

    <?= $form->field($model, 'date', [
        'template' => "{label}\n<div class=\"input-group date\" id=\"release-date-picker\" data-target-input=\"nearest\">{input}<div class=\"input-group-append\" data-target=\"#release-date-picker\" data-toggle=\"datetimepicker\"><div class=\"input-group-text\"><i class=\"fa fa-calendar\"></i></div></div></div>\n{error}\n{hint}",
    ])->textInput([
        'class' => 'form-control datetimepicker-input',
        'data-target' => '#release-date-picker',
    ]) ?>

    <?= $form->field($model, 'typeid', ['labelOptions' => ['label' => Yii::t('app', 'Type')]])->dropDownList($releaseTypes) ?>

    <?= $form->field($model, 'genre')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
