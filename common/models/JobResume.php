<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%job_resume}}".
 *
 * @property int $id
 * @property int|null $job_id
 * @property string $name
 * @property int $sex
 * @property string $email
 * @property string $mobile
 * @property string $birthday
 * @property int $province
 * @property int $marital_status
 * @property int $military_service_status
 * @property string|null $file_resume
 * @property string|null $description
 * @property int $status
 * @property int|null $updated_by
 * @property int|null $updated_at
 * @property int|null $created_at
 * @property int|null $created_by
 * @property int $deleted_at
 */
class JobResume extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%job_resume}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['job_id', 'sex', 'province', 'marital_status', 'military_service_status', 'status', 'updated_by', 'updated_at', 'created_at', 'created_by', 'deleted_at'], 'integer'],
            [['name', 'sex', 'email', 'mobile', 'birthday', 'province', 'marital_status', 'military_service_status', 'status'], 'required'],
            [['description'], 'string'],
            [['name', 'email', 'mobile', 'birthday', 'file_resume'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'job_id' => Yii::t('app', 'Job ID'),
            'name' => Yii::t('app', 'Name'),
            'sex' => Yii::t('app', 'Sex'),
            'email' => Yii::t('app', 'Email'),
            'mobile' => Yii::t('app', 'Mobile'),
            'birthday' => Yii::t('app', 'Birthday'),
            'province' => Yii::t('app', 'Province'),
            'marital_status' => Yii::t('app', 'Marital Status'),
            'military_service_status' => Yii::t('app', 'Military Service Status'),
            'file_resume' => Yii::t('app', 'File Resume'),
            'description' => Yii::t('app', 'Description'),
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
     * @return JobResumeQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new JobResumeQuery(get_called_class());
    }
}
