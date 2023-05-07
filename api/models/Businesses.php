<?php

namespace api\models;

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
            'shortDescription' => 'short_description',
            'successStory' => 'success_story',
            'investorDescription' => 'investor_description',
            'slug',
            'wallpaper' => function (self $model) {
                return $model->getUploadUrl('wallpaper');
            },
            'mobileWallpaper' => function (self $model) {
                return $model->getUploadUrl('mobile_wallpaper');
            },
            'tabletWallpaper' => function (self $model) {
                return $model->getUploadUrl('tablet_wallpaper');
            },
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
            'services',
        ];
    }
}