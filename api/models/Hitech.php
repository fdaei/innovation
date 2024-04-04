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
            'time' => function($model){
                return \Yii::$app->pdate->jdate('Y/m/d H:i',$model->created_at);
            }
        ];
    }

    public function getJobCategories()
    {
        return $this->hasMany(FreelancerCategories::class, ['freelancer_id' => 'id'])->where(['model_class'=>Hitech::className()]);
    }
}
