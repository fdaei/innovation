<?php

namespace backend\models;
use yii\base\Model;
use Yii;
class MentorRecords extends Model
{

    public $isNewRecord = true;
    public $year;
    public $title;
    public $description;

    public function rules()
    {
        return [
            [['year','title','description'],'required'],
            [['year','title','description'],'string'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'year' => 'سال',
            'title' => 'عنوان سابقه',
            'description' => 'توضیح سابقه',
        ];
    }

    public static function handelData($defaultData = []){
        $postData = \common\models\Model::createMultiple(self::className());
        Model::loadMultiple($postData, Yii::$app->request->post());
        $headlinesJson = [];
        foreach ($postData as $index => $eachData) {
            if($eachData->validate()){
                $headlinesJson[] = [
                    'year' => $eachData->year,
                    'title' => $eachData->title,
                    'description' => $eachData->description,
                ];
            }
        }
        return $headlinesJson;
    }
    public static function loadDefaultValue($datas){
        $arrayData = [];
        for ($i = 0; $i < count($datas); $i++) {
            $arrayData[$i] = new self();
            $arrayData[$i]->attributes = $datas[$i];
        }
        if(empty($arrayData)){
            $arrayData = [new self()];
        }
        return $arrayData;

    }

}