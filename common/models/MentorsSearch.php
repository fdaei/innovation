<?php

namespace common\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Mentors;

/**
 * MentorsSearch represents the model behind the search form of `common\models\Mentors`.
 */
class MentorsSearch extends Mentors
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'consultation_face_to_face', 'consultation_online', 'status', 'updated_at', 'updated_by', 'created_by', 'created_at', 'deleted_at'], 'integer'],
            [['name', 'telegram', 'instagram', 'whatsapp', 'activity_field', 'profile_pic', 'activity_description', 'services', 'records'], 'safe'],
            [['consulting_fee'], 'number'],
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
        $query = Mentors::find();

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
            'user_id' => $this->user_id,
            'consulting_fee' => $this->consulting_fee,
            'consultation_face_to_face' => $this->consultation_face_to_face,
            'consultation_online' => $this->consultation_online,
            'status' => $this->status,
            'updated_at' => $this->updated_at,
            'updated_by' => $this->updated_by,
            'created_by' => $this->created_by,
            'created_at' => $this->created_at,
            'deleted_at' => $this->deleted_at,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'telegram', $this->telegram])
            ->andFilterWhere(['like', 'instagram', $this->instagram])
            ->andFilterWhere(['like', 'whatsapp', $this->whatsapp])
            ->andFilterWhere(['like', 'activity_field', $this->activity_field])
            ->andFilterWhere(['like', 'profile_pic', $this->profile_pic])
            ->andFilterWhere(['like', 'activity_description', $this->activity_description])
            ->andFilterWhere(['like', 'services', $this->services])
            ->andFilterWhere(['like', 'records', $this->records]);

        return $dataProvider;
    }
}
