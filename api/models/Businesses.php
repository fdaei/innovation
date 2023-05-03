<?php

namespace api\models;

use common\behaviors\CdnUploadImageBehavior;
use yii\base\Model;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\TimestampBehavior;
use yii2tech\ar\softdelete\SoftDeleteBehavior;

class Businesses extends \common\models\Businesses
{
    public function fields()
    {
        return [
            'id',
            'picture_desktop' => function (self $model) {
                return $model->getUploadUrl('picture_desktop');
            },
            'picture_mobile' => function (self $model) {
                return $model->getUploadUrl('picture_mobile');
            },
            'name',
            'business_logo' => function (self $model) {
                return $model->getUploadUrl('business_logo');
            },
            'site_name',
            'business_color',
            'business_en_name',
            'description_brief',
            'description',
            'website',
            'telegram',
            'instagram',
            'whatsapp',
            'pic_main_desktop' => function (self $model) {
                return $model->getUploadUrl('pic_main_desktop');
            },
            'pic_main_mobile' => function (self $model) {
                return $model->getUploadUrl('pic_main_mobile');
            },
            'pic_small1_desktop' => function (self $model) {
                return $model->getUploadUrl('pic_small1_desktop');
            },
            'pic_small1_mobile' => function (self $model) {
                return $model->getUploadUrl('pic_small1_mobile');
            },
            'pic_small2_desktop' => function (self $model) {
                return $model->getUploadUrl('pic_small2_desktop');
            },
            'pic_small2_mobile' => function (self $model) {
                return $model->getUploadUrl('pic_small2_mobile');
            },
            'statistics',
            'services',
            'investors',
            'investors' => function (self $model) {
                return $model->businessesInvestors;
            },
            'business_story' => function (self $model) {
                return $model->businessesStory;
            },
        ];
    }
}
