<?php

namespace app\controllers;

use app\models\Order;
use app\models\OrderStatus;
use app\models\Customer;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;

/**
 * OrderController implements the CRUD actions for Order model.
 */
class OrderController extends Controller
{
    /**
     * @inheritDoc
     */
    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                'access' => [
                    'class' => AccessControl::class,
                    'rules' => [
                        [
                            'allow' => true,
                            'roles' => ['@'],
                        ],
                    ],
                ],
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
     * Lists all Order models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Order::find()->with(['customers', 'orderStatuses']),
            'pagination' => [
                'pageSize' => false,
            ],
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
            'statuses' => OrderStatus::find()->all(),
        ]);
    }

    /**
     * Displays a single Order model.
     * @param int $id ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Order model.
     * If creation is successful, the browser will be redirected to the order's order-item index.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Order();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['/order-item/index', 'orderId' => $model->id]);
            }
        } else {
            $model->loadDefaultValues();
            $model->datetime = date('Y-m-d H:i:s');
        }

        return $this->render('create', [
            'model' => $model,
            'statusOptions' => $this->getStatusOptions(),
            'customerOptions' => $this->getCustomerOptions(),
        ]);
    }

    /**
     * Updates an existing Order model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['index']);
        }

        return $this->render('update', [
            'model' => $model,
            'statusOptions' => $this->getStatusOptions(),
            'customerOptions' => $this->getCustomerOptions(),
        ]);
    }

    /**
     * Deletes an existing Order model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Order model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Order the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Order::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }

    /**
     * Returns order status names keyed by their IDs.
     *
     * @return array
     */
    protected function getStatusOptions(): array
    {
        return OrderStatus::find()
            ->select(['name'])
            ->indexBy('id')
            ->column();
    }

    /**
     * Returns customer names and IDs keyed by customer ID.
     *
     * @return array
     */
    protected function getCustomerOptions(): array
    {
        $options = [];
        foreach (Customer::find()->orderBy(['username' => SORT_ASC])->all() as $customer) {
            $options[$customer->id] = sprintf('%s #%d', $customer->username, $customer->id);
        }

        return $options;
    }
}
