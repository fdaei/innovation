<?php

namespace backend\models;

use common\models\Log;
use common\traits\CoreTrait;
use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 *
 * @property string $log_time_start
 * @property string $log_time_end
 */
class LogSearch extends Log
{
    use CoreTrait;

    public $log_time_start;
    public $log_time_end;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'level'], 'integer'],
            [['category', 'prefix', 'message'], 'safe'],
            [['log_time_start', 'log_time_end'], 'safe'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'log_time_end' => Yii::t('app', 'Log Time End'),
            'log_time_start' => Yii::t('app', 'Log Time Start'),
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
            'sort' => [
                'defaultOrder' => ['id' => SORT_DESC]
            ]
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'level' => $this->level
        ]);

        $query
            ->andFilterWhere(['like', 'category', $this->category])
            ->andFilterWhere(['like', 'prefix', $this->prefix])
            ->andFilterWhere(['like', 'message', $this->message]);

        if ($this->log_time_start) {
            $logTimeStart = $this->jalaliToTimestamp($this->log_time_start, "Y/m/d H:i");

            $query->andFilterWhere(['>=', 'log_time', $logTimeStart]);
        }

        if ($this->log_time_end) {
            $logTimeEnd = $this->jalaliToTimestamp($this->log_time_end, "Y/m/d H:i");

            $query->andFilterWhere(['<=', 'log_time', $logTimeEnd]);
        }

        return $dataProvider;
    }
}