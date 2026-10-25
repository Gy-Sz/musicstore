<?php

use app\models\OrderItem;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\widgets\Pjax;

/** @var yii\web\View $this */
/** @var yii\data\ActiveDataProvider $dataProvider */
/** @var app\models\Order|null $order */

$this->title = $order === null
    ? Yii::t('app', 'Order Items')
    : Yii::t('app', 'Order #{id} Items', ['id' => $order->id]);
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="order-item-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(
            Yii::t('app', 'Create Order Item'),
            $order === null ? ['create'] : ['create', 'orderId' => $order->id],
            ['class' => 'btn btn-success']
        ) ?>
    </p>

    <?php Pjax::begin(); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'orderid',
            'productid',
            'priceid',
            'quantity',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, OrderItem $model, $key, $index, $column) use ($order) {
                    $route = [$action, 'id' => $model->id];
                    if ($order !== null) {
                        $route['orderId'] = $order->id;
                    }

                    return Url::toRoute($route);
                }
            ],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
