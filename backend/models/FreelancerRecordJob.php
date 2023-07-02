<?php

namespace backend\models;

use yii;
use yii\base\Model;

class FreelancerRecordJob extends Model
{

    public $isNewRecord = true;
    public $title;

    public function rules()
    {
        return [
            [['title'],'required'],
            [['title'],'string'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'title' => 'عنوان',
        ];
    }


    public static function Handler($items = []){
        $items = \common\models\Model::createMultiple(FreelancerRecordJob::class);
        Model::loadMultiple($items, Yii::$app->request->post());
        $itemJson = [];
        foreach ($items as $index => $item) {
            if($item->validate()){
                $itemJson[] = [
                    'title' => $item->title,
                ];
            }
        }
        return $itemJson;
    }
    public static function loadDefaultValue($item){
        $items = [];
        for ($i = 0; $i < count($item); $i++) {
            $items[$i] = new FreelancerRecordJob();
            $items[$i]->attributes = $item[$i];
            $items[$i]->isNewRecord = false;

        }
        if(empty($items)){
            $items = [new FreelancerRecordJob];
        }
        return $items;

    }

}