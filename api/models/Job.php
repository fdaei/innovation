<?php

namespace api\models;

use common\behaviors\CdnUploadImageBehavior;
use yii\base\Model;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\TimestampBehavior;
use yii2tech\ar\softdelete\SoftDeleteBehavior;

class Job extends \common\models\Job
{
    public function fields()
    {
        return [
            'id',
            'title',
            'job_category',
            'type_cooperation',
            'time_cooperation',
            'location',
            'description',
            'required_skills',
            'business' => function (self $model) {
                $business = $model->business;
                return [$business->id,$business->name,$business->description_brief];
            },

        ];
    }
}
