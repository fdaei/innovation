<?php

namespace common\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use api\models\Mentor;

/**
 * MentorSearch represents the model behind the search form of `common\models\Mentor`.
 */
class MentorSearch extends Mentor
{
    public $categories;
    public $picture_mentor;
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'status', 'user_id', 'updated_by', 'created_at', 'created_by', 'updated_at', 'deleted_at'], 'integer'],
            [['picture', 'video', 'instagram', 'linkedin', 'twitter', 'whatsapp', 'telegram', 'activity_field', 'activity_description', 'services', 'records','categories'], 'safe'],
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

        if($this->categories){
            $query->joinWith('mentorCategories')
                ->andFilterWhere(['in', 'categories_id', $this->categories]);
        }


        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'status' => $this->status,
            'user_id' => $this->user_id,
            'updated_by' => $this->updated_by,
            'created_at' => $this->created_at,
            'created_by' => $this->created_by,
            'updated_at' => $this->updated_at,
            'deleted_at' => $this->deleted_at,
        ]);

        $query->andFilterWhere(['like', 'picture', $this->picture])
            ->andFilterWhere(['like', 'video', $this->video])
            ->andFilterWhere(['like', 'instagram', $this->instagram])
            ->andFilterWhere(['like', 'linkedin', $this->linkedin])
            ->andFilterWhere(['like', 'twitter', $this->twitter])
            ->andFilterWhere(['like', 'whatsapp', $this->whatsapp])
            ->andFilterWhere(['like', 'telegram', $this->telegram])
            ->andFilterWhere(['like', 'activity_field', $this->activity_field])
            ->andFilterWhere(['like', 'activity_description', $this->activity_description]);

        return $dataProvider;
    }
}
