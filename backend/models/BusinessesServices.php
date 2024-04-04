<?php

namespace backend\models;

use yii;
use common\behaviors\CdnUploadImageBehavior;
use yii\base\Model;
use yii\web\UploadedFile;

class BusinessesServices extends Model
{

    public $isNewRecord = true;
    public $imageFile;
    public $pic;
    public $title;
    public $description;

    public function rules()
    {
        return [
            [['title'],'required'],
            [['title','description','pic'],'string'],
            [['imageFile'], 'file', 'skipOnEmpty' => true, 'extensions' => 'png, jpg, jpeg'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'title' => 'نام',
            'description' => 'توضیحات',
        ];
    }

    public function upload()
    {
        if ($this->validate()) {
            if($this->imageFile){
                $name = $this->imageFile->baseName . rand(1000000,99999999). '.' . $this->imageFile->extension;
                $this->imageFile->saveAs('@inceRoot/businesses/' . $name);
                return $name;
            }
            return false;
        } else {
            return false;
        }
    }

    public static function handelData($defaultData = []){
        $postData = \common\models\Model::createMultiple(self::class);
        Model::loadMultiple($postData, Yii::$app->request->post());
        $headlinesJson = [];
        foreach ($postData as $index => $eachData) {
            if($eachData->validate()){
                $eachData->imageFile = UploadedFile::getInstanceByName( self::class."[{$index}][imageFile]");
                $fileName = $eachData->upload();
                $fileName = ($fileName ? $fileName : (isset($defaultData[$index]['pic']) ? $defaultData[$index]['pic']: ''));
                $headlinesJson[] = [
                    'title' => $eachData->title,
                    'description' => $eachData->description,
                    'pic' => $fileName,
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