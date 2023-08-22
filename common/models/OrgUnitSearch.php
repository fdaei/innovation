<?php

namespace common\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * OrgUnitSearch represents the model behind the search form of `common\models\OrgUnit`.
 */
class OrgUnitSearch extends OrgUnit
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'status', 'created_at', 'created_by', 'updated_at', 'updated_by', 'deleted_at'], 'integer'],
            [['title', 'description'], 'safe'],
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
        $query = OrgUnit::find();

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
            OrgUnit::tableName() . '.id' => $this->id,
            OrgUnit::tableName() . '.status' => $this->status,
            OrgUnit::tableName() . '.created_at' => $this->created_at,
            OrgUnit::tableName() . '.created_by' => $this->created_by,
            OrgUnit::tableName() . '.updated_at' => $this->updated_at,
            OrgUnit::tableName() . '.updated_by' => $this->updated_by,
            OrgUnit::tableName() . '.deleted_at' => $this->deleted_at,
        ]);

        $query->andFilterWhere(['like', OrgUnit::tableName() . '.title', $this->title])
            ->andFilterWhere(['like', OrgUnit::tableName() . '.description', $this->description]);

        return $dataProvider;
    }
}