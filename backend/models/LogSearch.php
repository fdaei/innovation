<?php

namespace backend\models;

use common\traits\CoreTrait;
use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use yii\behaviors\TimestampBehavior;
use common\models\Log;

/**
 * LogSearch represents the model behind the search form of `common\models\Log`.
 */
class LogSearch extends Log
{
    use CoreTrait;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'level'], 'integer'],
            [['category', 'prefix', 'message'], 'safe'],
            [['log_time'], 'safe'],
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
        $query = Log::find();

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
            'level' => $this->level
        ]);
        $query->andFilterWhere(['like', 'category', $this->category])
            ->andFilterWhere(['like', 'prefix', $this->prefix])
            ->andFilterWhere(['like', 'message', $this->message])
            ->andFilterWhere(['between', 'log_time', $this->jalaliToTimestamp($this->log_time, "Y/m/d H:i"),$this->jalaliToTimestamp($this->log_time, "Y/m/d H:i")+60]);
        $query->orderBy(['id' => SORT_DESC]);

        return $dataProvider;
    }
}
