<?php

namespace backend\models;

use yii;
use common\behaviors\CdnUploadImageBehavior;
use yii\base\Model;
use yii\web\UploadedFile;

class HitechRequireSkills extends Model
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
            'title' => 'نام مهارت',
        ];
    }


    public static function handelData($defaultData = []){
        $postData = \common\models\Model::createMultiple(self::class);
        Model::loadMultiple($postData, Yii::$app->request->post());
        $RequireSkills = [];
        foreach ($postData as $index => $eachData) {
            if($eachData->validate()){
                $RequireSkills[] = $eachData->title;
            }
        }
        return $RequireSkills;
    }
    public static function loadDefaultValue($datas){
        $arrayData = [];
        for ($i = 0; $i < count($datas); $i++) {
            $arrayData[$i] = new self();
             $arrayData[$i]->title = $datas[$i];
//            $arrayData[$i]->attributes = $datas[$i];
        }
        if(empty($arrayData)){
            $arrayData = [new self()];
        }
        return $arrayData;

    }
}
