<?php

use yii\helpers\Html;
use yii\helpers\Url;

/** @var yii\web\View $this */
/** @var yii\data\ActiveDataProvider $dataProvider */
/** @var app\models\OrderStatus[] $statuses */

$this->title = Yii::t('app', 'Orders');
$this->params['breadcrumbs'][] = $this->title;

$ordersByStatus = [];
foreach ($dataProvider->getModels() as $order) {
    $ordersByStatus[$order->statusid][] = $order;
}

$this->registerCss(<<<CSS
.order-kanban-board {
    display: flex;
    gap: 1rem;
    overflow-x: auto;
    align-items: flex-start;
    padding-bottom: 1rem;
}
.order-kanban-column {
    flex: 0 0 18rem;
    min-width: 0;
}
CSS);
?>
<div class="order-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Create Order'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <div class="order-kanban-board" aria-label="<?= Html::encode(Yii::t('app', 'Orders by status')) ?>">
        <?php foreach ($statuses as $status): ?>
            <section class="order-kanban-column card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h2 class="h6 mb-0"><?= Html::encode($status->name) ?></h2>
                    <span class="badge bg-secondary"><?= count($ordersByStatus[$status->id] ?? []) ?></span>
                </div>
                <div class="card-body d-flex flex-column gap-3">
                    <?php foreach ($ordersByStatus[$status->id] ?? [] as $order): ?>
                        <article class="card shadow-sm">
                            <div class="card-body">
                                <h3 class="h6 card-title">
                                    <?= Html::encode(Yii::t('app', 'Order #{id}', ['id' => $order->id])) ?>
                                </h3>
                                <p class="card-text mb-1">
                                    <strong><?= Html::encode(Yii::t('app', 'Customer')) ?>:</strong>
                                    <?= Html::encode($order->customers->username ?? Yii::t('app', 'Unknown customer')) ?>
                                </p>
                                <p class="card-text mb-3">
                                    <strong><?= Html::encode(Yii::t('app', 'Order date')) ?>:</strong>
                                    <?= Html::encode(Yii::$app->formatter->asDate($order->datetime)) ?>
                                </p>
                                <div class="d-flex gap-2">
                                    <?= Html::a(
                                        Yii::t('app', 'View'),
                                        Url::to(['view', 'id' => $order->id]),
                                        ['class' => 'btn btn-sm btn-outline-secondary']
                                    ) ?>
                                    <?= Html::a(
                                        Yii::t('app', 'Edit'),
                                        Url::to(['update', 'id' => $order->id]),
                                        ['class' => 'btn btn-sm btn-outline-primary']
                                    ) ?>
                                    <?= Html::a(
                                        Yii::t('app', 'Items'),
                                        Url::to(['/order-item/index', 'orderId' => $order->id]),
                                        ['class' => 'btn btn-sm btn-outline-info']
                                    ) ?>
                                </div>
                            </div>
                        </article>
                    <?php endforeach; ?>
                    <?php if (empty($ordersByStatus[$status->id])): ?>
                        <p class="text-muted small mb-0"><?= Html::encode(Yii::t('app', 'No orders')) ?></p>
                    <?php endif; ?>
                </div>
            </section>
        <?php endforeach; ?>
    </div>

</div>
