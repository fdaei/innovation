<?php

namespace backend\models;

use common\models\Model;
use yii\base\Model as BaseModel;

class FreelancerSkills extends BaseModel
{
    public $isNewRecord = true;
    public $title;

    public function rules()
    {
        return [
            [['title'], 'required'],
            [['title'], 'string'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'title' => 'عنوان',
        ];
    }

    public static function Handler($items = [])
    {
        $data['FreelancerSkills'] = $items;
        $items = Model::createMultiple(FreelancerSkills::class, [], $items);
        Model::loadMultiple($items, $data);
        $itemJson = [];
        foreach ($items as $index => $item) {
            if ($item->validate()) {
                $itemJson[] = [
                    'title' => $item->title,
                ];
            }
        }
        return $itemJson;
    }

    public static function loadDefaultValue($item)
    {
        $items = [];
        for ($i = 0; $i < count($item); $i++) {
            $items[$i] = new FreelancerSkills();
            $items[$i]->attributes = $item[$i];
            $items[$i]->isNewRecord = false;

        }

        if (empty($items)) {
            $items = [new FreelancerSkills];
        }

        return $items;
    }
}