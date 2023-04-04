<?php

namespace common\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Freelancer;

/**
 * FreelancerSearch represents the model behind the search form of `common\models\Freelancer`.
 */
class FreelancerSearch extends \api\models\Freelancer
{
    public $categories;
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'sex', 'city', 'province', 'marital_status', 'military_service_status', 'project_number', 'status', 'updated_by', 'updated_at', 'created_at', 'created_by', 'deleted_at'], 'integer'],
            [['header_picture_desktop', 'header_picture_mobile', 'freelancer_picture', 'freelancer_description', 'name', 'email', 'mobile', 'activity_field', 'experience', 'experience_period', 'skills', 'record_job', 'record_educational', 'portfolio', 'resume_file', 'description_user','categories'], 'safe'],
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
        $query = Freelancer::find();

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
            'sex' => $this->sex,
            'city' => $this->city,
            'province' => $this->province,
            'marital_status' => $this->marital_status,
            'military_service_status' => $this->military_service_status,
            'project_number' => $this->project_number,
            'status' => $this->status,
            'updated_by' => $this->updated_by,
            'updated_at' => $this->updated_at,
            'created_at' => $this->created_at,
            'created_by' => $this->created_by,
            'deleted_at' => $this->deleted_at,
        ]);




        if($this->categories){
            $query->joinWith('freelancerCategories')
                ->andFilterWhere(['in', 'categories_id', $this->categories]);
        }

        $query->andFilterWhere(['like', 'header_picture_desktop', $this->header_picture_desktop])
            ->andFilterWhere(['like', 'header_picture_mobile', $this->header_picture_mobile])
            ->andFilterWhere(['like', 'freelancer_picture', $this->freelancer_picture])
            ->andFilterWhere(['like', 'freelancer_description', $this->freelancer_description])
            ->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'email', $this->email])
            ->andFilterWhere(['like', 'mobile', $this->mobile])
            ->andFilterWhere(['like', 'activity_field', $this->activity_field])
            ->andFilterWhere(['like', 'experience', $this->experience])
            ->andFilterWhere(['like', 'experience_period', $this->experience_period])
            ->andFilterWhere(['like', 'skills', $this->skills])
            ->andFilterWhere(['like', 'record_job', $this->record_job])
            ->andFilterWhere(['like', 'record_educational', $this->record_educational])
            ->andFilterWhere(['like', 'portfolio', $this->portfolio])
            ->andFilterWhere(['like', 'resume_file', $this->resume_file])
            ->andFilterWhere(['like', 'description_user', $this->description_user]);

        return $dataProvider;
    }
}
