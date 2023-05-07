<?php

namespace backend\models;

use yii;
use yii\base\Model;

class EventTimes extends Model
{

    public $isNewRecord = true;
    public $start;
    public $end;

    public function rules()
    {
        return [
            [['start','end'],'required'],
            [['start','end'],'safe'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'start' => 'زمان شروع',
            'end' => 'زمان پایان',
        ];
    }

    public static function handelData(){
        $eventTimes = \common\models\Model::createMultiple(EventTimes::classname());
        Model::loadMultiple($eventTimes, Yii::$app->request->post());
        $headlinesJson = [];
        foreach ($eventTimes as $eventTime) {
            if($eventTime->validate()){
                $headlinesJson[] = [
                    'start' => $eventTime->start,
                    'end' => $eventTime->end,
                ];
            }
        }
        return $headlinesJson;
    }
    public static function loadDefaultValue($event_times){
        $eventTimes = [];
        for ($i = 0; $i < count($event_times); $i++) {
            $eventTimes[$i] = new EventTimes();
            $eventTimes[$i]->attributes = $event_times[$i];
        }
        if(empty($eventTimes)){
            $eventTimes = [new EventTimes];
        }
        return $eventTimes;

    }
}
