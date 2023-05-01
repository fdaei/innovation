<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%job}}".
 *
 * @property int $id
 * @property int|null $business_id
 * @property string|null $title
 * @property string|null $job_category
 * @property string|null $type_cooperation
 * @property string $time_cooperation
 * @property string|null $location
 * @property string|null $description
 * @property string $required_skills
 * @property int $status
 * @property int|null $updated_by
 * @property int|null $updated_at
 * @property int|null $created_at
 * @property int|null $created_by
 * @property int $deleted_at
 */
class Job extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%job}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['business_id', 'status', 'updated_by', 'updated_at', 'created_at', 'created_by', 'deleted_at'], 'integer'],
            [['time_cooperation', 'required_skills', 'status'], 'required'],
            [['description'], 'string'],
            [['required_skills'], 'safe'],
            [['title', 'job_category', 'type_cooperation', 'time_cooperation', 'location'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'business_id' => Yii::t('app', 'Business ID'),
            'title' => Yii::t('app', 'Title'),
            'job_category' => Yii::t('app', 'Job Category'),
            'type_cooperation' => Yii::t('app', 'Type Cooperation'),
            'time_cooperation' => Yii::t('app', 'Time Cooperation'),
            'location' => Yii::t('app', 'Location'),
            'description' => Yii::t('app', 'Description'),
            'required_skills' => Yii::t('app', 'Required Skills'),
            'status' => Yii::t('app', 'Status'),
            'updated_by' => Yii::t('app', 'Updated By'),
            'updated_at' => Yii::t('app', 'Updated At'),
            'created_at' => Yii::t('app', 'Created At'),
            'created_by' => Yii::t('app', 'Created By'),
            'deleted_at' => Yii::t('app', 'Deleted At'),
        ];
    }

    /**
     * {@inheritdoc}
     * @return JobQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new JobQuery(get_called_class());
    }


    public function getBusiness()
    {
        return $this->hasOne(Businesses::class, ['id' => 'business_id']);
    }

    public function getJobCategories()
    {
        return $this->hasMany(FreelancerCategories::class, ['freelancer_id' => 'id'])->where(['model_class'=>Job::className()]);
    }
}
