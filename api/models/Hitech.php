<?php

namespace api\models;

use common\behaviors\CdnUploadImageBehavior;
use common\models\FreelancerCategories;
use yii\base\Model;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\TimestampBehavior;
use yii2tech\ar\softdelete\SoftDeleteBehavior;

class Hitech extends \common\models\Hitech
{
    public function fields()
    {
        return [
            'id',
            'title',
            'description',
            'minimum_budget',
            'maximum_budget',
            'required_skills',
        ];
    }

    public function getJobCategories()
    {
        return $this->hasMany(FreelancerCategories::class, ['freelancer_id' => 'id'])->where(['model_class'=>Hitech::className()]);
    }
}
