<?php

namespace api\models;

use common\behaviors\CdnUploadImageBehavior;
use yii\base\Model;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\TimestampBehavior;
use yii\db\Expression;
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
            'organizerInfo',
            'price',
            'price_before_discount',
            'evand_link',
            'description',
            'headlines',
            'event_times',
            'sponsor' => function (self $model) {
                return $model->eventSponsorsInfo;
            },
            'address',
            'longitude',
            'latitude',
            'status' => function (self $model) {
                $status= $model->status;
                $expire=true;
                foreach ($model->event_times as $val) {
                    if($val['end'] > new Expression('NOW()')){
                        $expire=false;
                    }
                }
                $model->status=$expire?3:$status;
                return [
                    'code' => $model->status,
                    'name' => \common\models\Event::itemAlias('Status', $model->status),
                ];
            },
        ];
    }
}
