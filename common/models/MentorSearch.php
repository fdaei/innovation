<?php

namespace common\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Mentor;

/**
 * MentorSearch represents the model behind the search form of `common\models\Mentor`.
 */
class MentorSearch extends Mentor
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'status', 'user_id', 'consultation_face_to_face', 'consultation_online', 'updated_by', 'created_at', 'created_by', 'updated_at', 'deleted_at'], 'integer'],
            [['name', 'mobile', 'picture', 'resume', 'video', 'instagram', 'linkedin', 'twitter', 'documents', 'description', 'job_records', 'education_records', 'whatsapp', 'telegram', 'activity_field', 'activity_description', 'services', 'records'], 'safe'],
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
        $query = Mentor::find();

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
            'status' => $this->status,
            'user_id' => $this->user_id,
            'consulting_fee' => $this->consulting_fee,
            'consultation_face_to_face' => $this->consultation_face_to_face,
            'consultation_online' => $this->consultation_online,
            'updated_by' => $this->updated_by,
            'created_at' => $this->created_at,
            'created_by' => $this->created_by,
            'updated_at' => $this->updated_at,
            'deleted_at' => $this->deleted_at,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'mobile', $this->mobile])
            ->andFilterWhere(['like', 'picture', $this->picture])
            ->andFilterWhere(['like', 'resume', $this->resume])
            ->andFilterWhere(['like', 'video', $this->video])
            ->andFilterWhere(['like', 'instagram', $this->instagram])
            ->andFilterWhere(['like', 'linkedin', $this->linkedin])
            ->andFilterWhere(['like', 'twitter', $this->twitter])
            ->andFilterWhere(['like', 'documents', $this->documents])
            ->andFilterWhere(['like', 'description', $this->description])
            ->andFilterWhere(['like', 'job_records', $this->job_records])
            ->andFilterWhere(['like', 'education_records', $this->education_records])
            ->andFilterWhere(['like', 'whatsapp', $this->whatsapp])
            ->andFilterWhere(['like', 'telegram', $this->telegram])
            ->andFilterWhere(['like', 'activity_field', $this->activity_field])
            ->andFilterWhere(['like', 'activity_description', $this->activity_description])
            ->andFilterWhere(['like', 'services', $this->services])
            ->andFilterWhere(['like', 'records', $this->records]);

        return $dataProvider;
    }
}
