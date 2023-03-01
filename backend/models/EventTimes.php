<?php

namespace backend\models;

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

}
