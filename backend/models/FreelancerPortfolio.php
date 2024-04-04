<?php

namespace backend\models;

use common\behaviors\CdnUploadImageBehavior;
use yii;
use yii\base\Model as BaseModel;
use common\models\Model;

class FreelancerPortfolio extends BaseModel
{

    public bool $isNewRecord = true;
    public $title;
    public $description;
    public $image;
    public $link;

    public function rules()
    {
        return [
            [['title'], 'required'],
            [['title', 'description', 'link'], 'string'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'title' => 'عنوان',
            'description' => 'توضیحات',
            'image' => 'تصویر',
            'link' => 'لینک نمونه کار',
        ];
    }

    public static function Handler($items = [])
    {
        $items = Model::createMultiple(FreelancerPortfolio::class);
        Model::loadMultiple($items, Yii::$app->request->post());
        $itemJson = [];
        foreach ($items as $index => $item) {
            if ($item->validate()) {
                $itemJson[] = [
                    'title' => $item->title,
                    'description' => $item->description,
                    'image' => $item->image,
                    'link' => $item->link,
                ];
            }
        }
        return $itemJson;
    }

    public static function loadDefaultValue($item)
    {
        $items = [];
        for ($i = 0; $i < count($item); $i++) {
            $items[$i] = new FreelancerPortfolio();
            $items[$i]->attributes = $item[$i];
            $items[$i]->isNewRecord = false;
        }
        if (empty($items)) {
            $items = [new FreelancerPortfolio];
        }
        return $items;
    }

    public function behaviors()
    {
        return [
            [
                'class' => CdnUploadImageBehavior::class,
                'attribute' => 'image',
                'scenarios' => [self::SCENARIO_DEFAULT],
                'instanceByName' => false,
                'deleteBasePathOnDelete' => false,
                'createThumbsOnSave' => false,
                'transferToCDN' => true,
                'cdnPath' => "@cdnRoot/freelancer",
                'basePath' => "@inceRoot/freelancer",
                'path' => "@inceRoot/freelancer",
                'url' => "@cdnWeb/freelancer"
            ],
        ];
    }
}