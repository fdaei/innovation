<?php

namespace api\models;

class Event extends \common\models\Event
{
    public function fields()
    {
        return [
            'id',
            'title',
            'titleBrief'=>'title_brief',
            'picture' => function (self $model) {
                return $model->getUploadUrl('picture');
            },
            'organizerInfo',
            'price',
            'priceBeforeDiscount'=>'price_before_discount',
            'evandlink'=>'evand_link',
            'description',
            'headlines',
            'sponsor' => function (self $model) {
                return $model->eventSponsorsInfo;
            },
            'address',
            'longitude',
            'latitude',
            'status' => function (self $model) {
                $status = $model->status;
                $expire = true;
                foreach ($model->event_times as $time) {
                    $nowDate = time();
                    if ($time->end_at > $nowDate) {
                        $expire = false;
                    }
                }
                $model->status = $expire ? self::STATUS_HELD : $status;
                return [
                    'code' => $model->status,
                    'title' => Event::itemAlias('Status', $model->status),
                ];
            },
        ];
    }
}