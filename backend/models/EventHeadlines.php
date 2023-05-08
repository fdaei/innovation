<?php

namespace backend\models;

use yii;
use common\behaviors\CdnUploadImageBehavior;
use yii\base\Model;
use yii\web\UploadedFile;

class EventHeadlines extends Model
{

    public $isNewRecord = true;
    public $pic;
    public $title;
    public $description;

    public function rules()
    {
        return [
            [['title','description'],'required'],
            [['title','description','pic'],'string'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'pic' => 'عنوان سرفصل',
            'title' => 'عنوان سرفصل',
            'description' => 'توضیحات سرفصل',
        ];
    }


    public static function handelData($headlines = []){
        $eventHeadlines = \common\models\Model::createMultiple(EventHeadlines::class);
        Model::loadMultiple($eventHeadlines, Yii::$app->request->post());
        $headlinesJson = [];
        foreach ($eventHeadlines as $index => $eventHeadline) {
            if($eventHeadline->validate()){
                $headlinesJson[] = [
                    'title' => $eventHeadline->title,
                    'description' => $eventHeadline->description,
                ];
            }
        }
        return $headlinesJson;
    }
    public static function loadDefaultValue($headlines){
        $eventHeadlines = [];
        for ($i = 0; $i < count($headlines); $i++) {
            $eventHeadlines[$i] = new EventHeadlines();
            $eventHeadlines[$i]->attributes = $headlines[$i];
        }
        if(empty($eventHeadlines)){
            $eventHeadlines = [new EventHeadlines];
        }
        return $eventHeadlines;

    }

}
