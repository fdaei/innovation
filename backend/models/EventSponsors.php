<?php

namespace backend\models;

use yii;
use common\behaviors\CdnUploadImageBehavior;
use yii\base\Model;
use yii\web\UploadedFile;

class EventSponsors extends Model
{

    public $isNewRecord = true;
    public $imageFileSponsors;
    public $pic;
    public $title;
    public $description;
    public $instagram;
    public $telegram;
    public $whatsapp;

    public function rules()
    {
        return [
            [['title','description'],'required'],
            [['title','description','pic','instagram','telegram','whatsapp'],'string'],
            [['imageFileSponsors'], 'file', 'skipOnEmpty' => true, 'extensions' => 'png, jpg, jpeg'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'title' => 'نام حامی رویداد',
            'description' => 'حوزه فعالیت',
        ];
    }

    public function upload()
    {
        if ($this->validate()) {
            if($this->imageFileSponsors){
                $name = $this->imageFileSponsors->baseName . rand(1000000,99999999). '.' . $this->imageFileSponsors->extension;
                $this->imageFileSponsors->saveAs('@inceRoot/event/' . $name);
                return $name;
            }
            return false;
        } else {
            return false;
        }
    }

    public static function sponsorsHandler($sponsors = []){
        $eventSponsors = \common\models\Model::createMultiple(EventSponsors::class);
        Model::loadMultiple($eventSponsors, Yii::$app->request->post());
        $headlinesJson = [];
        foreach ($eventSponsors as $index => $eventHeadline) {
            if($eventHeadline->validate()){
                $eventHeadline->imageFileSponsors = UploadedFile::getInstanceByName( "EventSponsors[{$index}][imageFileSponsors]");
                $fileName = $eventHeadline->upload();
                $fileName = ($fileName ? $fileName : (isset($sponsors[$index]['pic']) ? $sponsors[$index]['pic']: ''));
                $headlinesJson[] = [
                    'title' => $eventHeadline->title,
                    'description' => $eventHeadline->description,
                    'instagram' => $eventHeadline->instagram,
                    'telegram' => $eventHeadline->telegram,
                    'whatsapp' => $eventHeadline->whatsapp,
                    'pic' => $fileName,
                ];
            }
        }
        return $headlinesJson;
    }
    public static function loadDefaultValue($sponsors){
        $eventSponsors = [];
        for ($i = 0; $i < count($sponsors); $i++) {
            $eventSponsors[$i] = new EventSponsors();
            $eventSponsors[$i]->attributes = $sponsors[$i];
        }
        if(empty($eventSponsors)){
            $eventSponsors = [new EventSponsors];
        }
        return $eventSponsors;

    }

}
