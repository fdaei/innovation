<?php

namespace common\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\EventOrganizer;

/**
 * EventOrganizerSearch represents the model behind the search form of `common\models\EventOrganizer`.
 */
class EventOrganizerSearch extends EventOrganizer
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'updated_at', 'updated_by', 'created_at', 'created_by', 'deleted_at'], 'integer'],
            [['organizer_name', 'organizer_avatar', 'organizer_picture', 'organizer_title_brief', 'organizer_instagram', 'organizer_telegram', 'organizer_linkedin'], 'safe'],
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
        $query = EventOrganizer::find();

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
            'updated_at' => $this->updated_at,
            'updated_by' => $this->updated_by,
            'created_at' => $this->created_at,
            'created_by' => $this->created_by,
            'deleted_at' => $this->deleted_at,
        ]);

        $query->andFilterWhere(['like', 'organizer_name', $this->organizer_name])
            ->andFilterWhere(['like', 'organizer_avatar', $this->organizer_avatar])
            ->andFilterWhere(['like', 'organizer_picture', $this->organizer_picture])
            ->andFilterWhere(['like', 'organizer_title_brief', $this->organizer_title_brief])
            ->andFilterWhere(['like', 'organizer_instagram', $this->organizer_instagram])
            ->andFilterWhere(['like', 'organizer_telegram', $this->organizer_telegram])
            ->andFilterWhere(['like', 'organizer_linkedin', $this->organizer_linkedin]);

        return $dataProvider;
    }
}
