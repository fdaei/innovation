<?php

namespace backend\models;

use common\behaviors\CdnUploadImageBehavior;
use yii\base\Model;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\TimestampBehavior;
use yii2tech\ar\softdelete\SoftDeleteBehavior;

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
            [['title','description'],'string'],
//            ['pic','safe']
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

    public function behaviors()
    {
        return [
//            [
//                'class' => CdnUploadImageBehavior::class,
//                'attribute' => 'pic',
//                'scenarios' => [self::SCENARIO_DEFAULT],
//                'instanceByName' => false,
//                //'placeholder' => "/assets/images/default.jpg",
//                'deleteBasePathOnDelete' => false,
//                'createThumbsOnSave' => false,
//                'transferToCDN' => false,
//                'cdnPath' => "@cdnRoot/event",
//                'basePath' => "@inceRoot/event",
//                'path' => "@inceRoot/event",
//                'url' => "@cdnWeb/event"
//            ],
        ];
    }
}
