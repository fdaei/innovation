<?php

namespace backend\models;

use yii;
use common\behaviors\CdnUploadImageBehavior;
use yii\base\Model;
use yii\web\UploadedFile;

class EventHeadlines extends Model
{

    public $isNewRecord = true;
    public $imageFileHeadlines;
    public $pic;
    public $title;
    public $description;

    public function rules()
    {
        return [
            [['title','description'],'required'],
            [['title','description','pic'],'string'],
            [['imageFileHeadlines'], 'file', 'skipOnEmpty' => true, 'extensions' => 'png, jpg, jpeg'],
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

    public function upload()
    {
        if ($this->validate()) {
            if($this->imageFileHeadlines){
                $name = $this->imageFileHeadlines->baseName . rand(1000000,99999999). '.' . $this->imageFileHeadlines->extension;
                $this->imageFileHeadlines->saveAs('@inceRoot/event/' . $name);
                return $name;
            }
            return false;
        } else {
            return false;
        }
    }

    public static function headLineHandler($headlines = []){
        $eventHeadlines = \common\models\Model::createMultiple(EventHeadlines::classname());
        Model::loadMultiple($eventHeadlines, Yii::$app->request->post());
        $headlinesJson = [];
        foreach ($eventHeadlines as $index => $eventHeadline) {
            if($eventHeadline->validate()){
                $eventHeadline->imageFileHeadlines = UploadedFile::getInstanceByName( "EventHeadlines[{$index}][imageFileHeadlines]");
                $fileName = $eventHeadline->upload();
                $fileName = ($fileName ? $fileName : (isset($headlines[$index]['pic']) ? $headlines[$index]['pic']: ''));
                $headlinesJson[] = [
                    'title' => $eventHeadline->title,
                    'description' => $eventHeadline->description,
                    'pic' => $fileName,
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
