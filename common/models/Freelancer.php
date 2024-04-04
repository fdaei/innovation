<?php

namespace common\models;

use common\behaviors\CdnUploadImageBehavior;
use Yii;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveQuery;
use yii2tech\ar\softdelete\SoftDeleteBehavior;
use yii\db\ActiveRecord;
/**
 * This is the model class for table "{{%freelancer}}".
 *
 * @property int $id
 * @property string|null $header_picture_desktop
 * @property string|null $header_picture_mobile
 * @property string|null $freelancer_picture
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
 * @property string|null $record_job
 * @property string|null $record_educational
 * @property string|null $resume_file
 * @property string $description_user
 * @property string|null $freelancer_description
 * @property int|null $project_number
 * @property int $status
 * @property int|null $updated_by
 * @property int $updated_at
 * @property int $created_at
 * @property int|null $created_by
 * @property int $deleted_at
 * @property int $user_id
 * @property boolean $accept_rules
 *
 * @property User $createdBy
 * @property FreelancerCategories[] $freelancerCategories
 * @property FreelancerPortfolio[] $freelancerPortfolios
 * @property User $updatedBy
 * @property User $user
 *
 * @mixin CdnUploadImageBehavior;
 * @mixin TimestampBehavior
 * @mixin BlameableBehavior
 * @mixin SoftDeleteBehavior
 *
 */
class Freelancer extends ActiveRecord
{
    const STATUS_PENDING = 0;
    const STATUS_ACTIVE = 1;
    const STATUS_INACTIVE = 2;
    const STATUS_DELETED = 3;

    const EXPERIENCE_ENTRY = 1;
    const EXPERIENCE_MID_LEVEL= 2;
    const EXPERIENCE_SENIOR= 3;
    const EXPERIENCE_TECHNICAL= 4;

    const SEX_MAN = 1;
    const SEX_WOMAN = 2;

    const MARTIAL_STATUS_SINGEL = 1;
    const MARTIAL_STATUS_MARRIED = 2;

    const MILITARY_STATUS_DONE = 1;
    const MILITARY_STATUS_INCLUDED = 2;
    const MILITARY_STATUS_EXEMPT = 3;

    const SCENARIO_API = 'api';

    public $categories_list = [];
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
            [['name', 'email', 'mobile', 'city', 'province', 'marital_status', 'military_service_status', 'activity_field', 'experience', 'user_id','experience_period'], 'required'],
            [['sex', 'city', 'province', 'experience_period', 'marital_status', 'military_service_status', 'project_number', 'status', 'updated_by', 'updated_at', 'created_at', 'created_by', 'deleted_at', 'user_id'], 'integer'],
            [['record_job', 'record_educational','skills','resume_file','header_picture_desktop','header_picture_mobile','freelancer_picture'], 'safe'],
            ['accept_rules', 'required', 'requiredValue' => 1, 'message' => Yii::t('app', 'You must accept the rules')],
            [['email'], 'email'],
            [['mobile'], 'string', 'max' => 11],
            [['mobile'], 'match', 'pattern' => '^09[0-9]{9}$^'],
            [['skills', 'record_job', 'record_educational'], 'safe'],
            [['description_user','freelancer_description'], 'string'],
            ['status', 'default', 'value' => self::STATUS_PENDING, 'on' => self::SCENARIO_API],
            [['header_picture_desktop','header_picture_mobile','freelancer_picture'], 'image','extensions' => 'jpg, jpeg, png', 'enableClientValidation' => false],
            [['name', 'email', 'mobile', 'activity_field', 'experience', 'experience_period'], 'string', 'max' => 255],
            [['created_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['created_by' => 'id']],
            [['updated_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['updated_by' => 'id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['user_id' => 'id']],
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
            'resume_file' => Yii::t('app', 'Resume File'),
            'description_user' => Yii::t('app', 'Further Details'),
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
            'freelancer_description' => Yii::t('app', 'freelancer description'),
            'accept_rules' => Yii::t('app', 'Accept Rules'),

        ];
    }

    /**
     * {@inheritdoc}
     * @return FreelancerQuery the active query used by this AR class.
     */
    public static function find()
    {
        $query = new FreelancerQuery(get_called_class());
        return $query->notDeleted();
    }

    public function getFreelancerCategories()
    {
        return $this->hasMany(FreelancerCategories::class, ['freelancer_id' => 'id']);
    }

    public function getProvince(){
        return Province::findOne(['id' => $this->province]);
    }
    public function getCity(){
        return City::findOne(['id' => $this->city]);
    }
    /**
     * Gets query for [[FreelancerPortfolios]].
     *
     * @return ActiveQuery|FreelancerPortfolioQuery
     */
    public function getFreelancerPortfolios()
    {
        return $this->hasMany(FreelancerPortfolio::class, ['freelancer_id' => 'id'])->inverseOf('freelancer');
    }

    /**
     * Gets query for [[CreatedBy]].
     *
     * @return \yii\db\ActiveQuery|yii\db\ActiveQuery
     */
    public function getCreatedBy()
    {
        return $this->hasOne(User::class, ['id' => 'created_by'])->inverseOf('freelancers');
    }

    /**
     * Gets query for [[UpdatedBy]].
     *
     * @return \yii\db\ActiveQuery|yii\db\ActiveQuery
     */
    public function getUpdatedBy()
    {
        return $this->hasOne(User::class, ['id' => 'updated_by'])->inverseOf('freelancers0');
    }

    /**
     * Gets query for [[User]].
     *
     * @return \yii\db\ActiveQuery|yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::class, ['id' => 'user_id'])->inverseOf('freelancers1');
    }

    public function behaviors()
    {
        return [
            'timestamp' => [
                'class' => TimestampBehavior::class
            ],
            [
                'class' => BlameableBehavior::class,
                'createdByAttribute' => 'created_by',
                'updatedByAttribute' => 'updated_by',
            ],
            'softDeleteBehavior' => [
                'class' => SoftDeleteBehavior::class,
                'softDeleteAttributeValues' => [
                    'deleted_at' => time(),
                    'status' => self::STATUS_DELETED,
                ],
                'restoreAttributeValues' => [
                    'deleted_at' => 0,
                    'status' => [self::STATUS_ACTIVE, self::STATUS_PENDING, self::STATUS_INACTIVE]
                ],
                'replaceRegularDelete' => false, // mutate native `delete()` method
                'invokeDeleteEvents' => false
            ],
            [
                'class' => CdnUploadImageBehavior::class,
                'attribute' => 'resume_file',
                'scenarios' => [self::SCENARIO_DEFAULT],
                'instanceByName' => false,
                'deleteBasePathOnDelete' => false,
                'createThumbsOnSave' => false,
                'transferToCDN' => true,
                'cdnPath' => "@cdnRoot/freelancer/{id}",
                'basePath' => "@inceRoot/freelancer/{id}",
                'path' => "@inceRoot/freelancer/{id}",
                'url' => "@cdnWeb/freelancer/{id}"
            ],
            [
                'class' => CdnUploadImageBehavior::class,
                'attribute' => 'header_picture_desktop',
                'scenarios' => [self::SCENARIO_DEFAULT],
                'instanceByName' => false,
                'deleteBasePathOnDelete' => false,
                'createThumbsOnSave' => false,
                'transferToCDN' => true,
                'cdnPath' => "@cdnRoot/freelancer/{id}",
                'basePath' => "@inceRoot/freelancer/{id}",
                'path' => "@inceRoot/freelancer/{id}",
                'url' => "@cdnWeb/freelancer/{id}"
            ],[
                'class' => CdnUploadImageBehavior::class,
                'attribute' => 'header_picture_mobile',
                'scenarios' => [self::SCENARIO_DEFAULT],
                'instanceByName' => false,
                'deleteBasePathOnDelete' => false,
                'createThumbsOnSave' => false,
                'transferToCDN' => true,
                'cdnPath' => "@cdnRoot/freelancer/{id}",
                'basePath' => "@inceRoot/freelancer/{id}",
                'path' => "@inceRoot/freelancer/{id}",
                'url' => "@cdnWeb/freelancer/{id}"
            ],[
                'class' => CdnUploadImageBehavior::class,
                'attribute' => 'freelancer_picture',
                'scenarios' => [self::SCENARIO_DEFAULT],
                'instanceByName' => false,
                'deleteBasePathOnDelete' => false,
                'createThumbsOnSave' => false,
                'transferToCDN' => true,
                'cdnPath' => "@cdnRoot/freelancer/{id}",
                'basePath' => "@inceRoot/freelancer/{id}",
                'path' => "@inceRoot/freelancer/{id}",
                'url' => "@cdnWeb/freelancer/{id}"
            ],
        ];
    }

    public static function itemAlias($type, $code = NULL)
    {
        $_items = [
            'AcceptRules' => [
                0 => Yii::t('app', 'I didn\'t accept the rules'),
                1 => Yii::t('app', 'I accept all rules'),
            ],
            'Status' => [
                self::STATUS_ACTIVE => Yii::t('app', 'Ready to cooperate'),
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
            ],
            'Experience' => [
                self::EXPERIENCE_ENTRY => Yii::t('app', 'Entry'),
                self::EXPERIENCE_MID_LEVEL => Yii::t('app', 'Mid level'),
                self::EXPERIENCE_SENIOR => Yii::t('app', 'Senior'),
                self::EXPERIENCE_TECHNICAL => Yii::t('app', 'Technical'),
            ]
        ];
        if (isset($code))
            return isset($_items[$type][$code]) ? $_items[$type][$code] : false;
        else
            return isset($_items[$type]) ? $_items[$type] : false;
    }
}
