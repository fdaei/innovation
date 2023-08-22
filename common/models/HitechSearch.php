<?php

namespace common\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use api\models\Hitech;

/**
 * HitechSearch represents the model behind the search form of `common\models\Hitech`.
 */
class HitechSearch extends Hitech
{
    public $categories;
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'status', 'updated_by', 'updated_at', 'created_at', 'created_by', 'deleted_at'], 'integer'],
            [['title', 'description', 'required_skills','categories'], 'safe'],
            [['minimum_budget', 'maximum_budget'], 'number'],
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
        $query = Hitech::find();

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
            $query->joinWith('hitechCategories')
                ->andFilterWhere(['in', 'categories_id', $this->categories]);
        }
        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'minimum_budget' => $this->minimum_budget,
            'maximum_budget' => $this->maximum_budget,
            'status' => $this->status,
            'updated_by' => $this->updated_by,
            'updated_at' => $this->updated_at,
            'created_at' => $this->created_at,
            'created_by' => $this->created_by,
            'deleted_at' => $this->deleted_at,
        ]);

        $query->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'description', $this->description])
            ->andFilterWhere(['like', 'required_skills', $this->required_skills]);

        return $dataProvider;
    }
}
