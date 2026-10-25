<?php

use app\models\Price;
use app\models\Product;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\widgets\Pjax;

/** @var yii\web\View $this */
/** @var yii\data\ActiveDataProvider $dataProvider */
/** @var Product|null $product */

$product = $product ?? null;
$this->title = $product === null
    ? Yii::t('app', 'Prices')
    : Yii::t('app', 'Prices for Product #{id}', ['id' => $product->id]);
if ($product !== null) {
    $this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Products'), 'url' => ['/product/index']];
}
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="price-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(
            Yii::t('app', 'Create Price'),
            $product === null ? ['create'] : ['create', 'productId' => $product->id],
            ['class' => 'btn btn-success']
        ) ?>
    </p>

    <?php Pjax::begin(); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'productid',
            'value',
            'currency',
            'startdate',
            //'enddate',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Price $model, $key, $index, $column) use ($product) {
                    $route = [$action, 'id' => $model->id];
                    if ($product !== null) {
                        $route['productId'] = $product->id;
                    }

                    return Url::toRoute($route);
                }
            ],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
