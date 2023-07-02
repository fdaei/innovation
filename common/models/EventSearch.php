<?php

namespace common\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * EventSearch represents the model behind the search form of `common\models\Event`.
 *
 */
class EventSearch extends Event
{
    const FILTER_COMING_SOON = 1;
    const FILTER_RUNNING = 2;
    const FILTER_PASSED = 3;

    public $filter;

    public $tag_ids = [];

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'updated_at', 'updated_by', 'created_at', 'created_by', 'deleted_at', 'filter'], 'integer'],
            ['filter', 'in', 'range' => array_keys(self::itemAlias('Filter'))],
            [['title', 'description', 'headlines', 'address', 'sponsors', 'tag_ids'], 'safe'],
            [['price', 'price_before_discount', 'longitude', 'latitude'], 'number'],
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
    public function search($params, $formName = null)
    {
        $query = Event::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => [
                'defaultOrder' => ['id' => SORT_DESC]
            ]
        ]);

        $this->load($params, $formName);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'price' => $this->price,
            'price_before_discount' => $this->price_before_discount,
            'longitude' => $this->longitude,
            'latitude' => $this->latitude,
            'updated_at' => $this->updated_at,
            'updated_by' => $this->updated_by,
            'created_at' => $this->created_at,
            'created_by' => $this->created_by,
            'deleted_at' => $this->deleted_at,
        ]);

        $query->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'description', $this->description])
            ->andFilterWhere(['like', 'headlines', $this->headlines])
            ->andFilterWhere(['like', 'address', $this->address]);

        switch ($this->filter) {
            case self::FILTER_COMING_SOON:
                $query
                    ->innerJoin('{{%event_time}}', '{{%event_time}}.`event_id` = {{%event}}.`id`')
                    ->andWhere(['>', '{{%event_time}}.start_at', time()])
                    ->groupBy(Event::tableName() . '.id');
                break;
            case self::FILTER_RUNNING:
                $query
                    ->innerJoin('{{%event_time}}', '{{%event_time}}.`event_id` = {{%event}}.`id`')
                    ->andWhere(['<=', '{{%event_time}}.start_at', time()])
                    ->andWhere(['>', '{{%event_time}}.end_at', time()])
                    ->groupBy(Event::tableName() . '.id');

                break;
            case self::FILTER_PASSED:
                $query
                    ->innerJoin('{{%event_time}}', '{{%event_time}}.`event_id` = {{%event}}.`id`')
                    ->andWhere(['<', '{{%event_time}}.end_at', time()])
                    ->groupBy(Event::tableName() . '.id');

                break;
        }

        if ($this->tag_ids) {
            $query
                ->joinWith(['tags'], false)
                ->andWhere(['IN', Tag::tableName() . '.tag_id', $this->tag_ids])
                ->groupBy(Event::tableName() . '.id');
        }

        return $dataProvider;
    }
}