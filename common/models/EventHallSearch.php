<?php

namespace common\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\EventHall;

/**
 * EventHallSearch represents the model behind the search form of `common\models\EventHall`.
 */
class EventHallSearch extends EventHall
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'branche_id', 'capacity', 'updated_by', 'updated_at', 'created_at', 'created_by', 'deleted_at'], 'integer'],
            [['name', 'description', 'rules', 'specifications'], 'safe'],
            [['longitude', 'latitude'], 'number'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = EventHall::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'branche_id' => $this->branche_id,
            'longitude' => $this->longitude,
            'latitude' => $this->latitude,
            'capacity' => $this->capacity,
            'updated_by' => $this->updated_by,
            'updated_at' => $this->updated_at,
            'created_at' => $this->created_at,
            'created_by' => $this->created_by,
            'deleted_at' => $this->deleted_at,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'description', $this->description])
            ->andFilterWhere(['like', 'rules', $this->rules])
            ->andFilterWhere(['like', 'specifications', $this->specifications]);

        return $dataProvider;
    }
}
