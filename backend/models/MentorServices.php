<?php

namespace backend\models;

use common\behaviors\CdnUploadImageBehavior;
use yii\base\Model;
use Yii;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\TimestampBehavior;
use yii2tech\ar\softdelete\SoftDeleteBehavior;

class MentorServices extends Model
{

    public $isNewRecord = true;
    public $title;
    public $description;

    public function rules()
    {
        return [
            [['title','description'],'required'],
            [['title','description'],'string'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'title' => 'عنوان خدمت',
            'description' => 'توضیح کوتاه خدمت',
        ];
    }

    public static function handelData($defaultData = []){
        $postData = \common\models\Model::createMultiple(self::className());
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

    public function behaviors()
    {
        return [
            [
                'class' => CdnUploadImageBehavior::class,
                'attribute' => 'pic',
                'scenarios' => [self::SCENARIO_DEFAULT],
                'instanceByName' => false,
                //'placeholder' => "/assets/images/default.jpg",
                'deleteBasePathOnDelete' => false,
                'createThumbsOnSave' => false,
                'transferToCDN' => true,
                'cdnPath' => "@cdnRoot/MentorServices",
                'basePath' => "@inceRoot/MentorServices",
                'path' => "@inceRoot/MentorServices",
                'url' => "@cdnWeb/MentorServices"
            ],
        ];
    }
}
