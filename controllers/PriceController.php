<?php

namespace app\controllers;

use app\models\Price;
use app\models\Product;
use Yii;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;

/**
 * PriceController implements the CRUD actions for Price model.
 */
class PriceController extends Controller
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
     * Lists all Price models.
     *
     * @return string
     */
    public function actionIndex(?int $productId = null)
    {
        $product = $productId === null ? null : $this->findProduct($productId);
        $dataProvider = new ActiveDataProvider([
            'query' => Price::find()->andFilterWhere(['productid' => $productId]),
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
            'product' => $product,
        ]);
    }

    /**
     * Displays a single Price model.
     * @param int $id ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id, ?int $productId = null)
    {
        return $this->render('view', [
            'model' => $this->findModel($id, $productId),
            'productId' => $productId,
        ]);
    }

    /**
     * Creates a new Price model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate(?int $productId = null)
    {
        $product = $productId === null ? null : $this->findProduct($productId);
        $model = new Price();

        if ($this->request->isPost) {
            if ($model->load($this->request->post())) {
                if ($product !== null) {
                    $model->productid = $product->id;
                }
                if ($model->save()) {
                    $route = ['view', 'id' => $model->id];
                    if ($product !== null) {
                        $route['productId'] = $product->id;
                    }

                    return $this->redirect($route);
                }
            }
        } else {
            $model->loadDefaultValues();
            if ($product !== null) {
                $model->productid = $product->id;
            }
        }

        return $this->render('create', [
            'model' => $model,
            'product' => $product,
        ]);
    }

    /**
     * Updates an existing Price model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id, ?int $productId = null)
    {
        $model = $this->findModel($id, $productId);
        $product = $productId === null ? null : $this->findProduct($productId);

        if ($this->request->isPost && $model->load($this->request->post())) {
            if ($product !== null) {
                $model->productid = $product->id;
            }
            if ($model->save()) {
                $route = ['view', 'id' => $model->id];
                if ($product !== null) {
                    $route['productId'] = $product->id;
                }

                return $this->redirect($route);
            }
        }

        return $this->render('update', [
            'model' => $model,
            'product' => $product,
        ]);
    }

    /**
     * Deletes an existing Price model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id, ?int $productId = null)
    {
        $this->findModel($id, $productId)->delete();

        $route = ['index'];
        if ($productId !== null) {
            $route['productId'] = $productId;
        }

        return $this->redirect($route);
    }

    /**
     * Finds the Price model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Price the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id, ?int $productId = null)
    {
        $query = Price::find()->where(['id' => $id]);
        if ($productId !== null) {
            $query->andWhere(['productid' => $productId]);
        }

        if (($model = $query->one()) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }

    private function findProduct(int $id): Product
    {
        if (($product = Product::findOne(['id' => $id])) !== null) {
            return $product;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
}
