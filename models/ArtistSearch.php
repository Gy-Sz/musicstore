<?php

namespace app\models;

use yii\data\ActiveDataProvider;

class ArtistSearch extends Artist
{
    public function rules(): array
    {
        return [
            [['name', 'country'], 'string'],
        ];
    }

    public function search(array $params): ActiveDataProvider
    {
        $query = Artist::find();
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);
        if (!$this->validate()) {
            $query->andWhere('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'country', $this->country]);

        return $dataProvider;
    }
}
