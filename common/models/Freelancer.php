<?php

namespace common\models;

use common\behaviors\CdnUploadImageBehavior;
use Yii;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\TimestampBehavior;
use yii2tech\ar\softdelete\SoftDeleteBehavior;

/**
 * This is the model class for table "{{%freelancer}}".
 *
 * @property int $id
 * @property string $name
 * @property int|null $sex
 * @property string $email
 * @property string $mobile
 * @property int $city
 * @property int $province
 * @property int $marital_status
 * @property int $military_service_status
 * @property string $activity_field
 * @property string $experience
 * @property string $experience_period
 * @property string $skills
 * @property string $record_job
 * @property string $record_educational
 * @property string|null $portfolio
 * @property string $resume_file
 * @property string $description_user
 * @property int|null $project_number
 * @property int $status
 * @property int $updated_by
 * @property int $updated_at
 * @property int $created_at
 * @property int $created_by
 * @property int $deleted_at
 */
class Freelancer extends \yii\db\ActiveRecord
{
    const STATUS_PENDING = 0;
    const STATUS_ACTIVE = 1;
    const STATUS_INACTIVE = 2;

    const SEX_MAN = 1;
    const SEX_WOMAN = 2;

    const MARTIAL_STATUS_SINGEL = 1;
    const MARTIAL_STATUS_MARRIED = 2;

    const MILITARY_STATUS_DONE = 1;
    const MILITARY_STATUS_INCLUDED = 2;
    const MILITARY_STATUS_EXEMPT = 3;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%freelancer}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'email', 'mobile', 'city', 'province', 'marital_status', 'military_service_status', 'activity_field', 'experience', 'experience_period', 'skills',], 'required'],
            [['sex', 'city', 'province', 'marital_status', 'military_service_status', 'project_number', 'status', 'updated_by', 'updated_at', 'created_at', 'created_by', 'deleted_at'], 'integer'],
            [['record_job', 'record_educational', 'portfolio'], 'safe'],
            [['description_user'], 'string'],
            [['name', 'email', 'mobile', 'activity_field', 'experience', 'experience_period'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'name' => Yii::t('app', 'Name'),
            'sex' => Yii::t('app', 'Sex'),
            'email' => Yii::t('app', 'Email'),
            'mobile' => Yii::t('app', 'Mobile'),
            'city' => Yii::t('app', 'City'),
            'province' => Yii::t('app', 'Province'),
            'marital_status' => Yii::t('app', 'Marital Status'),
            'military_service_status' => Yii::t('app', 'Military Service Status'),
            'activity_field' => Yii::t('app', 'Activity Field'),
            'experience' => Yii::t('app', 'Experience'),
            'experience_period' => Yii::t('app', 'Experience Period'),
            'skills' => Yii::t('app', 'Skills'),
            'record_job' => Yii::t('app', 'Record Job'),
            'record_educational' => Yii::t('app', 'Record Educational'),
            'portfolio' => Yii::t('app', 'Portfolio'),
            'resume_file' => Yii::t('app', 'Resume File'),
            'description_user' => Yii::t('app', 'Description User'),
            'project_number' => Yii::t('app', 'Project Number'),
            'status' => Yii::t('app', 'Status'),
            'updated_by' => Yii::t('app', 'Updated By'),
            'updated_at' => Yii::t('app', 'Updated At'),
            'created_at' => Yii::t('app', 'Created At'),
            'created_by' => Yii::t('app', 'Created By'),
            'deleted_at' => Yii::t('app', 'Deleted At'),
            'header_picture_desktop' => Yii::t('app', 'header picture desktop'),
            'header_picture_mobile' => Yii::t('app', 'header picture mobile'),
            'freelancer_picture' => Yii::t('app', 'profile picture'),
            'freelancer_description' => Yii::t('app', 'description'),
        ];
    }

    /**
     * {@inheritdoc}
     * @return FreelancerQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new FreelancerQuery(get_called_class());
    }

    public function getFreelancerCategories()
    {
        return $this->hasMany(FreelancerCategories::class, ['freelancer_id' => 'id'])->where(['model_class'=>Freelancer::className()]);
    }

    public function getProvince(){
        return Province::findOne(['id' => $this->province]);
    }
    public function getCity(){
        return City::findOne(['id' => $this->city]);
    }

    public function behaviors()
    {
        return [
            'timestamp' => [
                'class' => TimestampBehavior::class
            ],
            [
                'class' => BlameableBehavior::class,
                'createdByAttribute' => null,
                'updatedByAttribute' => 'updated_by',
            ],
            'softDeleteBehavior' => [
                'class' => SoftDeleteBehavior::class,
                'softDeleteAttributeValues' => [
                    'deleted_at' => time(),
                ],
                'restoreAttributeValues' => [
                    'deleted_at' => 0,
                ],
                'replaceRegularDelete' => false, // mutate native `delete()` method
                'invokeDeleteEvents' => false
            ],
            [
                'class' => CdnUploadImageBehavior::class,
                'attribute' => 'resume_file',
                'scenarios' => [self::SCENARIO_DEFAULT],
                'instanceByName' => false,
                //'placeholder' => "/assets/images/default.jpg",
                'deleteBasePathOnDelete' => false,
                'createThumbsOnSave' => false,
                'transferToCDN' => false,
                'cdnPath' => "@cdnRoot/events",
                'basePath' => "@inceRoot/events",
                'path' => "@inceRoot/events",
                'url' => "@cdnWeb/events"
            ],
            [
                'class' => CdnUploadImageBehavior::class,
                'attribute' => 'header_picture_desktop',
                'scenarios' => [self::SCENARIO_DEFAULT],
                'instanceByName' => false,
                //'placeholder' => "/assets/images/default.jpg",
                'deleteBasePathOnDelete' => false,
                'createThumbsOnSave' => false,
                'transferToCDN' => true,
                'cdnPath' => "@cdnRoot/events",
                'basePath' => "@inceRoot/events",
                'path' => "@inceRoot/events",
                'url' => "@cdnWeb/events"
            ],[
                'class' => CdnUploadImageBehavior::class,
                'attribute' => 'header_picture_mobile',
                'scenarios' => [self::SCENARIO_DEFAULT],
                'instanceByName' => false,
                //'placeholder' => "/assets/images/default.jpg",
                'deleteBasePathOnDelete' => false,
                'createThumbsOnSave' => false,
                'transferToCDN' => true,
                'cdnPath' => "@cdnRoot/events",
                'basePath' => "@inceRoot/events",
                'path' => "@inceRoot/events",
                'url' => "@cdnWeb/events"
            ],[
                'class' => CdnUploadImageBehavior::class,
                'attribute' => 'freelancer_picture',
                'scenarios' => [self::SCENARIO_DEFAULT],
                'instanceByName' => false,
                //'placeholder' => "/assets/images/default.jpg",
                'deleteBasePathOnDelete' => false,
                'createThumbsOnSave' => false,
                'transferToCDN' => true,
                'cdnPath' => "@cdnRoot/events",
                'basePath' => "@inceRoot/events",
                'path' => "@inceRoot/events",
                'url' => "@cdnWeb/events"
            ],
        ];
    }

    public static function itemAlias($type, $code = NULL)
    {
        $_items = [
            'Status' => [
                self::STATUS_ACTIVE => Yii::t('app', 'ACTIVE'),
                self::STATUS_INACTIVE => Yii::t('app', 'INACTIVE'),
                self::STATUS_PENDING => Yii::t('app', 'PENDING'),
            ],
            'Sex' => [
                self::SEX_MAN => Yii::t('app', 'Man'),
                self::SEX_WOMAN => Yii::t('app', 'Woman'),
            ],
            'Marital' => [
                self::MARTIAL_STATUS_SINGEL => Yii::t('app', 'Single'),
                self::MARTIAL_STATUS_MARRIED => Yii::t('app', 'Married'),
            ],
            'Military' => [
                self::MILITARY_STATUS_DONE => Yii::t('app', 'Done'),
                self::MILITARY_STATUS_INCLUDED => Yii::t('app', 'Included'),
                self::MILITARY_STATUS_EXEMPT => Yii::t('app', 'Exempt'),
            ]
        ];
        if (isset($code))
            return isset($_items[$type][$code]) ? $_items[$type][$code] : false;
        else
            return isset($_items[$type]) ? $_items[$type] : false;
    }
}
