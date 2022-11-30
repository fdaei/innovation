<?php

namespace common\models;

use common\behaviors\CdnUploadImageBehavior;
use Yii;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\TimestampBehavior;
use yii2tech\ar\softdelete\SoftDeleteBehavior;


/**
 * This is the model class for table "ince_career_apply".
 *
 * @property int $id
 * @property int $user_id
 * @property string $first_name
 * @property string $last_name
 * @property string $mobile
 * @property string $email
 * @property int $job_position_id
 * @property string $cv_file
 * @property string $description
 * @property int $status
 * @property int $created_at
 * @property int $updated_at
 * @property int $updated_by
 *
 * @property JobPosition $jobPosition
 * @property User $updatedBy
 * @property User $user
 */
class CareerApply extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    const STATUS_ACTIVE = 1;
    const STATUS_DELETED = 0;
    const STATUS_INACTIVE = 2;


    public static function tableName()
    {
        return 'ince_career_apply';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'first_name', 'last_name', 'mobile', 'email', 'job_position_id', 'cv_file', 'description', 'status',], 'required'],
            [['user_id', 'job_position_id', 'status',], 'integer'],
            [['first_name', 'last_name'], 'string', 'max' => 128],
            ['cv_file', 'file', 'extensions' => 'pdf', 'maxSize' => 1024 * 1024 * 3, 'mimeTypes' => ['application/pdf']],
            [['mobile'], 'string', 'max' => 11],
            [['email'], 'string', 'max' => 256],
            [['description'], 'string', 'max' => 1024],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['user_id' => 'id']],
            [['updated_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['updated_by' => 'id']],
            [['job_position_id'], 'exist', 'skipOnError' => true, 'targetClass' => JobPosition::class, 'targetAttribute' => ['job_position_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'user_id' => Yii::t('app', 'User ID'),
            'first_name' => Yii::t('app', 'First Name'),
            'last_name' => Yii::t('app', 'Last Name'),
            'mobile' => Yii::t('app', 'Mobile'),
            'email' => Yii::t('app', 'Email'),
            'job_position_id' => Yii::t('app', 'Job Position ID'),
            'cv_file' => Yii::t('app', 'Cv File'),
            'description' => Yii::t('app', 'Description'),
            'status' => Yii::t('app', 'Status'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
            'updated_by' => Yii::t('app', 'Updated By'),
        ];
    }

    /**
     * Gets query for [[JobPosition]].
     *
     * @return \yii\db\ActiveQuery|CareerApplyQuery
     */
    public function getJobPosition()
    {
        return $this->hasOne(JobPosition::class, ['id' => 'job_position_id']);
    }

    /**
     * Gets query for [[UpdatedBy]].
     *
     * @return \yii\db\ActiveQuery|yii\db\ActiveQuery
     */
    public function getUpdatedBy()
    {
        return $this->hasOne(User::class, ['id' => 'updated_by']);
    }

    /**
     * Gets query for [[User]].
     *
     * @return \yii\db\ActiveQuery|yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::class, ['id' => 'user_id']);
    }

    /**
     * {@inheritdoc}
     * @return CareerApplyQuery the active query used by this AR class.
     */
    public static function find()
    {
        $query = new CareerApplyQuery(get_called_class());
        return $query->active();
    }

    public function canDelete()
    {
        return true;
    }

    public static function itemAlias($type, $code = NULL)
    {
        $_items = [
            'Status' => [
                self::STATUS_DELETED => Yii::t('app', 'DELETED'),
                self::STATUS_ACTIVE => Yii::t('app', 'ACTIVE'),
                self::STATUS_INACTIVE => Yii::t('app', 'INACTIVE'),
            ],
            'StatusClass' => [
                self::STATUS_DELETED => 'danger',
                self::STATUS_ACTIVE => 'success',
                self::STATUS_INACTIVE => 'warning',
            ],
            'StatusColor' => [
                self::STATUS_DELETED => '#ff5050',
                self::STATUS_ACTIVE => '#04AA6D',
                self::STATUS_INACTIVE => '#eea236',
            ],];
        if (isset($code))
            return isset($_items[$type][$code]) ? $_items[$type][$code] : false;
        else
            return isset($_items[$type]) ? $_items[$type] : false;
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
                    'status' => self::STATUS_DELETED
                ],
                'restoreAttributeValues' => [
                    'deleted_at' => 0,
                    'status' => self::STATUS_ACTIVE
                ],
                'replaceRegularDelete' => false, // mutate native `delete()` method
                'invokeDeleteEvents' => false
            ],
            [
                'class' => CdnUploadImageBehavior::class,
                'attribute' => 'cv_file',
                'scenarios' => [self::SCENARIO_DEFAULT],
                'instanceByName' => false,
                'deleteBasePathOnDelete' => false,
                'createThumbsOnSave' => false,
                'transferToCDN' => false,
                'cdnPath' => "@cdnRoot/Apply",
                'basePath' => "@inceRoot/Apply",
                'path' => "@inceRoot/Apply",
                'url' => "@cdnWeb/Apply"
            ],
        ];
    }

    public function fields()
    {
        return [
            'id',
            'first_name',
            'last_name',
            'description',
        ];
    }

    public function extraFields()
    {
        return [];
    }
}
