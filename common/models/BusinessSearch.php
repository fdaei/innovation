<?php

namespace common\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Businesses;

/**
 * BusinessSearch represents the model behind the search form of `common\models\Businesses`.
 */
class BusinessSearch extends Businesses
{

    public function rules()
    {
        return [
            [['id', 'status'], 'integer'],
            [[ 'name', 'business_logo', 'business_color', 'business_en_name', 'description_brief', 'description', 'website', 'telegram', 'instagram', 'whatsapp', 'pic_main_desktop', 'pic_main_mobile', 'pic_small1_desktop', 'pic_small1_mobile', 'pic_small2_desktop', 'pic_small2_mobile', 'statistics', 'services', 'investors'], 'safe'],
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
        $query = Businesses::find();

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
            'updated_at' => $this->updated_at,
            'updated_by' => $this->updated_by,
            'created_by' => $this->created_by,
            'created_at' => $this->created_at,
            'deleted_at' => $this->deleted_at,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'business_color', $this->business_color])
            ->andFilterWhere(['like', 'business_en_name', $this->business_en_name])
            ->andFilterWhere(['like', 'description_brief', $this->description_brief])
            ->andFilterWhere(['like', 'description', $this->description])
            ->andFilterWhere(['like', 'website', $this->website])
            ->andFilterWhere(['like', 'telegram', $this->telegram])
            ->andFilterWhere(['like', 'instagram', $this->instagram])
            ->andFilterWhere(['like', 'whatsapp', $this->whatsapp])
            ->andFilterWhere(['like', 'investors', $this->investors]);

        return $dataProvider;
    }
}
