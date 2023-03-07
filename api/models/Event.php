<?php

namespace api\models;

use common\behaviors\CdnUploadImageBehavior;
use yii\base\Model;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\TimestampBehavior;
use yii2tech\ar\softdelete\SoftDeleteBehavior;

class Event extends \common\models\Event
{
    public function fields()
    {
        return [
            'id',
            'title',
            'title_brief',
            'picture' => function (self $model) {
                return $model->getUploadUrl('picture');
            },
            'price',
            'price_before_discount',
            'organizer_picture' => function (self $model) {
                return $model->getUploadUrl('organizer_picture');
            },
            'organizer_name',
            'organizer_title_brief',
            'organizer_instagram',
            'organizer_telegram',
            'organizer_linkedin',
            'evand_link',
            'description',
            'headline',
            'event_times',
            'sponsor',
            'address',
            'longitude',
            'latitude',
        ];
    }
}
