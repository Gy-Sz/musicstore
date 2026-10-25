<?php

namespace app\controllers;

use app\models\Order;
use app\models\OrderItem;
use app\models\Price;
use Yii;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * OrderItemController implements the CRUD actions for OrderItem model.
 */
class OrderItemController extends Controller
{
    /**
     * @inheritDoc
     */
    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                'verbs' => [
                    'class' => VerbFilter::className(),
                    'actions' => [
                        'delete' => ['POST'],
                    ],
                ],
            ]
        );
    }

    /**
     * Lists all OrderItem models.
     *
     * @return string
     */
    public function actionIndex(?int $orderId = null)
    {
        $order = $orderId === null ? null : $this->findOrder($orderId);
        $query = OrderItem::find()->andFilterWhere(['orderid' => $orderId]);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            /*
            'pagination' => [
                'pageSize' => 50
            ],
            'sort' => [
                'defaultOrder' => [
                    'id' => SORT_DESC,
                ]
            ],
            */
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
            'order' => $order,
        ]);
    }

    /**
     * Displays a single OrderItem model.
     * @param int $id ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id, ?int $orderId = null)
    {
        $model = $this->findModel($id, $orderId);

        return $this->render('view', [
            'model' => $model,
            'order' => $orderId === null ? null : $this->findOrder($orderId),
        ]);
    }

    /**
     * Creates a new OrderItem model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate(?int $orderId = null)
    {
        $order = $orderId === null ? null : $this->findOrder($orderId);
        $model = new OrderItem();

        if ($this->request->isPost) {
            if ($model->load($this->request->post())) {
                if ($order !== null) {
                    $model->orderid = $order->id;
                }
                if ($this->applyCatalogPriceWhenBlank($model) && $model->save()) {
                    return $this->redirect([
                        'index',
                        //'id' => $model->id,
                        'orderId' => $order?->id,
                    ]);
                }
            }
        } else {
            $model->loadDefaultValues();
            if ($order !== null) {
                $model->orderid = $order->id;
            }
        }

        return $this->render('create', [
            'model' => $model,
            'order' => $order,
        ]);
    }

    /**
     * Updates an existing OrderItem model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id, ?int $orderId = null)
    {
        $model = $this->findModel($id, $orderId);
        $order = $orderId === null ? null : $this->findOrder($orderId);

        if ($this->request->isPost && $model->load($this->request->post())) {
            if ($order !== null) {
                $model->orderid = $order->id;
            }
            if ($this->applyCatalogPriceWhenBlank($model) && $model->save()) {
                return $this->redirect([
                    'view',
                    'id' => $model->id,
                    'orderId' => $order?->id,
                ]);
            }
        }

        return $this->render('update', [
            'model' => $model,
            'order' => $order,
        ]);
    }

    /**
     * Deletes an existing OrderItem model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id, ?int $orderId = null)
    {
        $this->findModel($id, $orderId)->delete();

        return $this->redirect(['index', 'orderId' => $orderId]);
    }

    /**
     * Finds the OrderItem model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return OrderItem the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id, ?int $orderId = null)
    {
        $query = OrderItem::find()->where(['id' => $id]);
        if ($orderId !== null) {
            $query->andWhere(['orderid' => $orderId]);
        }

        if (($model = $query->one()) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }

    private function findOrder(int $id): Order
    {
        if (($order = Order::findOne(['id' => $id])) !== null) {
            return $order;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }

    private function applyCatalogPriceWhenBlank(OrderItem $model): bool
    {
        $priceValue = $model->getAttribute('price_value');
        $priceCurrency = $model->getAttribute('price_currency');
        $priceValueIsBlank = $priceValue === null || $priceValue === '';
        $priceCurrencyIsBlank = $priceCurrency === null || $priceCurrency === '';

        if (
            !$priceValueIsBlank
            || !$priceCurrencyIsBlank
        ) {
            return true;
        }

        $order = Order::findOne(['id' => $model->orderid]);
        if ($order === null) {
            return true;
        }

        $orderDate = Yii::$app->formatter->asDate($order->datetime, 'php:Y-m-d');
        $price = Price::find()
            ->where(['productid' => $model->productid])
            ->andWhere(['<=', 'startdate', $orderDate])
            ->andWhere(['>=', 'enddate', $orderDate])
            ->orderBy(['startdate' => SORT_DESC, 'id' => SORT_DESC])
            ->one();

        if ($price === null) {
            $model->addError(
                'price_value',
                Yii::t('app', 'No catalog price applies on the order date. Enter a price and currency manually.')
            );

            return false;
        }

        $model->price_value = $price->value;
        $model->price_currency = $price->currency;

        return true;
    }
}
