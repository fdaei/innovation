<?php

namespace common\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Businesses;

/**
 * BusinessesSearch represents the model behind the search form of `common\models\Businesses`.
 */
class BusinessesSearch extends Businesses
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'status', 'updated_at', 'updated_by', 'created_by', 'created_at', 'deleted_at'], 'integer'],
            [['picture_desktop', 'picture_mobile', 'name', 'description_brief', 'description', 'website', 'telegram', 'instagram', 'whatsapp', 'pic_main_desktop', 'pic_main_mobile', 'pic_small1_desktop', 'pic_small1_mobile', 'pic_small2_desktop', 'pic_small2_mobile', 'statistics', 'services', 'investors'], 'safe'],
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

        $query->andFilterWhere(['like', 'picture_desktop', $this->picture_desktop])
            ->andFilterWhere(['like', 'picture_mobile', $this->picture_mobile])
            ->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'description_brief', $this->description_brief])
            ->andFilterWhere(['like', 'description', $this->description])
            ->andFilterWhere(['like', 'website', $this->website])
            ->andFilterWhere(['like', 'telegram', $this->telegram])
            ->andFilterWhere(['like', 'instagram', $this->instagram])
            ->andFilterWhere(['like', 'whatsapp', $this->whatsapp])
            ->andFilterWhere(['like', 'pic_main_desktop', $this->pic_main_desktop])
            ->andFilterWhere(['like', 'pic_main_mobile', $this->pic_main_mobile])
            ->andFilterWhere(['like', 'pic_small1_desktop', $this->pic_small1_desktop])
            ->andFilterWhere(['like', 'pic_small1_mobile', $this->pic_small1_mobile])
            ->andFilterWhere(['like', 'pic_small2_desktop', $this->pic_small2_desktop])
            ->andFilterWhere(['like', 'pic_small2_mobile', $this->pic_small2_mobile])
            ->andFilterWhere(['like', 'statistics', $this->statistics])
            ->andFilterWhere(['like', 'services', $this->services])
            ->andFilterWhere(['like', 'investors', $this->investors]);

        return $dataProvider;
    }
}
