<?php

use app\models\Product;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\widgets\Pjax;

/** @var yii\web\View $this */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = Yii::t('app', 'Products');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="product-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Create Product'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php Pjax::begin(); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            [
                'attribute' => 'releaseid',
                'label' => Yii::t('app', 'Release'),
                'value' => static fn (Product $model) => $model->releases->title,
            ],
            [
                'attribute' => 'mediaid',
                'label' => Yii::t('app', 'Media'),
                'value' => static fn (Product $model) => $model->productMedias->name,
            ],
            'available_from_date',
            'stock',
            [
                'class' => ActionColumn::className(),
                'template' => '{view} {update} {delete} {prices}',
                'urlCreator' => function ($action, Product $model, $key, $index, $column) {
                    if ($action === 'prices') {
                        return Url::toRoute(['/price/index', 'productId' => $model->id]);
                    }

                    return Url::toRoute([$action, 'id' => $model->id]);
                },
                'buttons' => [
                    'prices' => static function ($url): string {
                        return Html::a(Yii::t('app', 'Prices'), $url, [
                            'title' => Yii::t('app', 'Manage prices for this product'),
                        ]);
                    },
                ],
            ],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
