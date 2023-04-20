<?php

namespace backend\models;

use common\behaviors\CdnUploadImageBehavior;
use yii\base\Model;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\TimestampBehavior;
use yii2tech\ar\softdelete\SoftDeleteBehavior;

class MentorServices extends Model
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
        ];
    }

    public function attributeLabels()
    {
        return [
            'pic' => 'عکس',
            'title' => 'عنوان خدمت',
            'description' => 'توضیح کوتاه خدمت',
        ];
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
