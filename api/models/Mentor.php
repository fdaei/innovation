<?php

namespace api\models;

use common\behaviors\CdnUploadImageBehavior;
use yii\base\Model;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\TimestampBehavior;
use yii2tech\ar\softdelete\SoftDeleteBehavior;

class Mentor extends \common\models\Mentor
{
    public function fields()
    {
        return [
            'id',
            'name',
            'picture' => function (self $model) {
                return $model->getUploadUrl('picture');
            },
            'picture_mentor' => function (self $model) {
                return $model->getUploadUrl('picture_mentor');
            },
            'activity_field',
            'activity_description',
            'instagram',
            'linkedin',
            'twitter',
            'telegram',
            'services' => function (self $model) {
                return $model->mentorServices;
            },
            'records',
            'resume_file'
        ];
    }
    public function extraFields()
    {
        return [
            'Category' => 'nameMentorCategories',
        ];
    }
}
