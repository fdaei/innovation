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
            'title' => 'title',
            'picture' => function (self $model) {
                return $model->getUploadUrl('picture');
            },
            'price',
            'price_before_discount',
            'evand_link',
            'description',
            'headlines',
            'event_times',
            'address',
            'longitude',
            'longitude',
        ];
    }
}
