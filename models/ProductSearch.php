<?php

namespace app\models;

use yii\data\ActiveDataProvider;

class ProductSearch extends Product
{
    public $releaseTitle;
    public $mediaName;

    public function rules(): array
    {
        return [
            [['releaseTitle', 'mediaName', 'available_from_date'], 'string'],
            [['stock'], 'integer'],
        ];
    }

    public function attributeLabels(): array
    {
        return array_merge(parent::attributeLabels(), [
            'releaseTitle' => \Yii::t('app', 'Release'),
            'mediaName' => \Yii::t('app', 'Media'),
        ]);
    }

    public function search(array $params): ActiveDataProvider
    {
        $query = Product::find()->joinWith([
            'releases release',
            'productMedias media',
        ]);
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);
        $dataProvider->sort->attributes['releaseTitle'] = [
            'asc' => ['release.title' => SORT_ASC],
            'desc' => ['release.title' => SORT_DESC],
        ];
        $dataProvider->sort->attributes['mediaName'] = [
            'asc' => ['media.name' => SORT_ASC],
            'desc' => ['media.name' => SORT_DESC],
        ];

        $this->load($params);
        if (!$this->validate()) {
            $query->andWhere('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere(['like', 'release.title', $this->releaseTitle])
            ->andFilterWhere(['like', 'media.name', $this->mediaName])
            ->andFilterWhere(['like', 'products.available_from_date', $this->available_from_date])
            ->andFilterWhere(['products.stock' => $this->stock]);

        return $dataProvider;
    }
}
