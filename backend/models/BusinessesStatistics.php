<?php

namespace backend\models;
use Yii;
use yii\base\Model;

class BusinessesStatistics extends Model
{
    const SCENARIO_CREATE = 'create';

    public $title;
    public $description;
    public $isNewRecord = true;

    public function rules()
    {
        return [
            [['title', 'description'], 'required'],
            // Add other validation rules
        ];
    }

    public function scenarios()
    {
        $scenarios = parent::scenarios();
        $scenarios[self::SCENARIO_CREATE] = ['title', 'description'];
        return $scenarios;
    }
    public function attributeLabels()
    {
        return [
            'title' => 'عنوان',
            'description' => 'توضیح',
        ];
    }

    public static function handelData($defaultData = []){
        $postData = \common\models\Model::createMultiple(self::class);
        Model::loadMultiple($postData, Yii::$app->request->post());
        $headlinesJson = [];
        foreach ($postData as $index => $eachData) {
            if($eachData->validate()){
                $headlinesJson[] = [
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