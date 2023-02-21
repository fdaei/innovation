<?php

namespace common\models;

use common\behaviors\CdnUploadImageBehavior;
use Yii;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\TimestampBehavior;
use yii2tech\ar\softdelete\SoftDeleteBehavior;

/**
 * This is the model class for table "{{%mentor}}".
 *
 * @property int $id
 * @property string $name
 * @property string $mobile
 * @property string $picture
 * @property string $resume
 * @property string|null $video
 * @property string|null $instagram
 * @property string|null $linkedin
 * @property string|null $twitter
 * @property string $documents
 * @property string $description
 * @property string $job_records
 * @property string $education_records
 * @property int $status
 * @property int $user_id
 * @property string|null $whatsapp
 * @property string|null $telegram
 * @property string $activity_field
 * @property string $activity_description
 * @property float $consulting_fee
 * @property int $consultation_face_to_face
 * @property int $consultation_online
 * @property string $services
 * @property string $records
 * @property int $updated_by
 * @property int $created_at
 * @property int $created_by
 * @property int $updated_at
 * @property int $deleted_at
 *
 * @property User $createdBy
 * @property User $updatedBy
 * @property User $user
 */
class Mentor extends \yii\db\ActiveRecord
{



    public static function tableName()
    {
        return '{{%mentor}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'mobile', 'picture', 'resume', 'documents', 'description', 'job_records', 'education_records', 'user_id', 'activity_field', 'activity_description', 'consulting_fee', 'consultation_face_to_face', 'consultation_online', 'services', 'records'], 'required'],
            [['documents', 'description', 'activity_description'], 'string'],
            [['job_records', 'education_records', 'services', 'records'], 'safe'],
            [['status', 'user_id', 'consultation_face_to_face', 'consultation_online', 'updated_by', 'created_at', 'created_by', 'updated_at', 'deleted_at'], 'integer'],
            [['consulting_fee'], 'number'],
            [['name','instagram', 'linkedin', 'twitter', 'whatsapp', 'telegram', 'activity_field'], 'string', 'max' => 255],
            [['mobile'], 'string', 'max' => 12],
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
            'mobile' => Yii::t('app', 'Mobile'),
            'picture' => Yii::t('app', 'Picture'),
            'resume' => Yii::t('app', 'Resume'),
            'video' => Yii::t('app', 'Video'),
            'instagram' => Yii::t('app', 'Instagram'),
            'linkedin' => Yii::t('app', 'Linkedin'),
            'twitter' => Yii::t('app', 'Twitter'),
            'documents' => Yii::t('app', 'Documents'),
            'description' => Yii::t('app', 'Description'),
            'job_records' => Yii::t('app', 'Job Records'),
            'education_records' => Yii::t('app', 'Education Records'),
            'status' => Yii::t('app', 'Status'),
            'user_id' => Yii::t('app', 'User ID'),
            'whatsapp' => Yii::t('app', 'Whatsapp'),
            'telegram' => Yii::t('app', 'Telegram'),
            'activity_field' => Yii::t('app', 'Activity Field'),
            'activity_description' => Yii::t('app', 'Activity Description'),
            'consulting_fee' => Yii::t('app', 'Consulting Fee'),
            'consultation_face_to_face' => Yii::t('app', 'Consultation Face To Face'),
            'consultation_online' => Yii::t('app', 'Consultation Online'),
            'services' => Yii::t('app', 'Services'),
            'records' => Yii::t('app', 'Records'),
            'updated_by' => Yii::t('app', 'Updated By'),
            'created_at' => Yii::t('app', 'Created At'),
            'created_by' => Yii::t('app', 'Created By'),
            'updated_at' => Yii::t('app', 'Updated At'),
            'deleted_at' => Yii::t('app', 'Deleted At'),
        ];
    }

    /**
     * Gets query for [[CreatedBy]].
     *
     * @return \yii\db\ActiveQuery|yii\db\ActiveQuery
     */
    public function getCreatedBy()
    {
        return $this->hasOne(User::class, ['id' => 'created_by']);
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
     * @return MentorQuery the active query used by this AR class.
     */
    public static function find()
    {
        $query = new MentorQuery(get_called_class());
        return $query->active();
    }

    public function canDelete()
    {
        return true;
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
                ],
                'restoreAttributeValues' => [
                    'deleted_at' => 0,
                ],
                'replaceRegularDelete' => false, // mutate native `delete()` method
                'invokeDeleteEvents' => false
            ],
            [
                'class' => CdnUploadImageBehavior::class,
                'attribute' => 'resume',
                'scenarios' => [self::SCENARIO_DEFAULT],
                'instanceByName' => false,
                //'placeholder' => "/assets/images/default.jpg",
                'deleteBasePathOnDelete' => false,
                'createThumbsOnSave' => false,
                'transferToCDN' => false,
                'cdnPath' => "@cdnRoot/mentor",
                'basePath' => "@inceRoot/mentor",
                'path' => "@inceRoot/mentor",
                'url' => "@cdnWeb/mentor"
            ],
            [
                'class' => CdnUploadImageBehavior::class,
                'attribute' => 'picture',
                'scenarios' => [self::SCENARIO_DEFAULT],
                'instanceByName' => false,
                //'placeholder' => "/assets/images/default.jpg",
                'deleteBasePathOnDelete' => false,
                'createThumbsOnSave' => false,
                'transferToCDN' => false,
                'cdnPath' => "@cdnRoot/mentor",
                'basePath' => "@inceRoot/mentor",
                'path' => "@inceRoot/mentor",
                'url' => "@cdnWeb/mentor"
            ],
            [
                'class' => CdnUploadImageBehavior::class,
                'attribute' => 'video',
                'scenarios' => [self::SCENARIO_DEFAULT],
                'instanceByName' => false,
                //'placeholder' => "/assets/images/default.jpg",
                'deleteBasePathOnDelete' => false,
                'createThumbsOnSave' => false,
                'transferToCDN' => false,
                'cdnPath' => "@cdnRoot/mentor",
                'basePath' => "@inceRoot/mentor",
                'path' => "@inceRoot/mentor",
                'url' => "@cdnWeb/mentor"
            ]
        ];
    }

    public function fields()
    {
        return [
            'id',
            'name',
            'mobile',
            'picture',
            'resume',
            'video',
            'instagram',
            'linkedin',
            'twitter',
            'documents',
            'description',
            'job_records',
            'education_records',
            'status',
            'user_id',
            'whatsapp',
            'telegram',
            'activity_field',
            'activity_description',
            'consulting_fee',
            'consultation_face_to_face',
            'consultation_online',
            'services',
            'records',
        ];
    }

    public function extraFields()
    {
        return [];
    }
}
