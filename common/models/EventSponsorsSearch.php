<?php

namespace common\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\EventSponsors;

/**
 * EventSponsorsSearch represents the model behind the search form of `common\models\EventSponsors`.
 */
class EventSponsorsSearch extends EventSponsors
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'event_id'], 'integer'],
            [['title', 'description', 'picture', 'instagram', 'telegram', 'whatsapp'], 'safe'],
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
        $query = EventSponsors::find();

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
            'event_id' => $this->event_id,
        ]);

        $query->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'description', $this->description])
            ->andFilterWhere(['like', 'picture', $this->picture])
            ->andFilterWhere(['like', 'instagram', $this->instagram])
            ->andFilterWhere(['like', 'telegram', $this->telegram])
            ->andFilterWhere(['like', 'whatsapp', $this->whatsapp]);

        return $dataProvider;
    }
}
