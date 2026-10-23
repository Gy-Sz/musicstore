<?php

use app\models\Release;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\widgets\Pjax;

/** @var yii\web\View $this */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = Yii::t('app', 'Releases');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="release-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Create Release'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php Pjax::begin(); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'title',
            [
                'attribute' => 'artistid',
                'label' => Yii::t('app', 'Artist'),
                'value' => static fn (Release $model) => $model->artists->name,
            ],
            'date',
            [
                'attribute' => 'typeid',
                'label' => Yii::t('app', 'Type'),
                'value' => static fn (Release $model) => $model->releaseTypes->name,
            ],
            //'genre',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Release $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                }
            ],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
