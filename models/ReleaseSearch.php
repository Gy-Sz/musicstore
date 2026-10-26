<?php

namespace app\models;

use yii\data\ActiveDataProvider;

class ReleaseSearch extends Release
{
    public $artistName;
    public $releaseTypeName;

    public function rules(): array
    {
        return [
            [['title', 'artistName', 'date', 'releaseTypeName', 'genre'], 'string'],
        ];
    }

    public function attributeLabels(): array
    {
        return array_merge(parent::attributeLabels(), [
            'artistName' => \Yii::t('app', 'Artist'),
            'releaseTypeName' => \Yii::t('app', 'Type'),
        ]);
    }

    public function search(array $params): ActiveDataProvider
    {
        $query = Release::find()->joinWith([
            'artists artist',
            'releaseTypes releaseType',
        ]);
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);
        $dataProvider->sort->attributes['artistName'] = [
            'asc' => ['artist.name' => SORT_ASC],
            'desc' => ['artist.name' => SORT_DESC],
        ];
        $dataProvider->sort->attributes['releaseTypeName'] = [
            'asc' => ['releaseType.name' => SORT_ASC],
            'desc' => ['releaseType.name' => SORT_DESC],
        ];

        $this->load($params);
        if (!$this->validate()) {
            $query->andWhere('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere(['like', 'releases.title', $this->title])
            ->andFilterWhere(['like', 'artist.name', $this->artistName])
            ->andFilterWhere(['like', 'releases.date', $this->date])
            ->andFilterWhere(['like', 'releaseType.name', $this->releaseTypeName])
            ->andFilterWhere(['like', 'releases.genre', $this->genre]);

        return $dataProvider;
    }
}
