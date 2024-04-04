<?php

namespace api\models;

use Yii;
class FreelancerCategoryList extends \common\models\FreelancerCategoryList
{
    public function fields()
    {
        return [
            'id',
            'title',
            'brief_description',
            'picture' => function (self $model) {
                return $model->getUploadUrl('picture');
            },
       ];
    }
}
