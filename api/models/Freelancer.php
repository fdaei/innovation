<?php

namespace api\models;

use common\behaviors\CdnUploadImageBehavior;
use yii\base\Model;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\TimestampBehavior;
use yii2tech\ar\softdelete\SoftDeleteBehavior;

class Freelancer extends \common\models\Freelancer
{
    public function fields()
    {
        return [
            'id',
            'header_picture_desktop' => function (self $model) {
                return $model->getUploadUrl('header_picture_desktop');
            },
            'header_picture_mobile' => function (self $model) {
                return $model->getUploadUrl('header_picture_mobile');
            },
            'freelancer_picture' => function (self $model) {
                return $model->getUploadUrl('freelancer_picture');
            },
            'freelancer_description',
            'name',
            'sex',
            'email',
            'mobile',
            'activity_field',
            'experience',
            'experience_period',
            'skills',
            'resume_file',
            'description_user',
            'project_number',
            'status',
            'accept_rules'
        ];
    }
}
