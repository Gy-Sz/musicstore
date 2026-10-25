<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\assets\Select2Asset;
use app\assets\TempusDominusAsset;

/** @var yii\web\View $this */
/** @var app\models\Product $model */
/** @var array $artists */
/** @var array $releaseTypes */
/** @var yii\widgets\ActiveForm $form */

Select2Asset::register($this);
$this->registerJs("$('#product-releaseid').select2({theme: 'bootstrap4', width: '100%'});");
TempusDominusAsset::register($this);
$this->registerJs("$('#product-date-picker').datetimepicker({format: 'YYYY-MM-DD'});");
?>

<div class="product-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'releaseid', ['labelOptions' => ['label' => Yii::t('app', 'Release')]])->dropDownList($releases, [
        'prompt' => Yii::t('app', 'Select a release'),
        'class' => 'form-control select2',
    ]) ?>

    <?= $form->field($model, 'mediaid', ['labelOptions' => ['label' => Yii::t('app', 'Media')]])->dropDownList($productMedias) ?>

    <?= $form->field($model, 'available_from_date', [
        'template' => "{label}\n<div class=\"input-group date\" id=\"product-date-picker\" data-target-input=\"nearest\">{input}<div class=\"input-group-append\" data-target=\"#product-date-picker\" data-toggle=\"datetimepicker\"><div class=\"input-group-text\"><i class=\"fa fa-calendar\"></i></div></div></div>\n{error}\n{hint}",
    ])->textInput([
        'class' => 'form-control datetimepicker-input',
        'data-target' => '#product-date-picker',
    ]) ?>

    <?= $form->field($model, 'stock')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
