<?php

namespace backend\models;

use yii;
use yii\base\Model;

class FreelancerRecordEducational extends Model
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
        $items = \common\models\Model::createMultiple(FreelancerRecordEducational::class);
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
            $items[$i] = new FreelancerRecordEducational();
            $items[$i]->attributes = $item[$i];
        }
        if(empty($items)){
            $items = [new FreelancerRecordEducational];
        }
        return $items;

    }

}