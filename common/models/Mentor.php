<?php

namespace common\models;

use common\behaviors\CdnUploadImageBehavior;
use Yii;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\TimestampBehavior;
use yii2tech\ar\softdelete\SoftDeleteBehavior;
use yii\db\ActiveQuery;

/**
 * This is the model class for table "{{%mentor}}".
 *
 * @property int $id
 * @property string $name
 * @property string $picture
 * @property string|null $video
 * @property string|null $instagram
 * @property string|null $linkedin
 * @property string|null $twitter
 * @property int $status
 * @property int $user_id
 * @property string|null $whatsapp
 * @property string|null $telegram
 * @property string|null $resume_file
 * @property string $activity_field
 * @property string $activity_description
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
 * @property MentorsAdviceRequest[] $mentorsAdviceRequests
 *
 * @mixin TimestampBehavior
 * @mixin BlameableBehavior
 * @mixin SoftDeleteBehavior
 * @mixin CdnUploadImageBehavior
 */
class Mentor extends \yii\db\ActiveRecord
{
    public $resume_file;
    const STATUS_ACTIVE = 1;
    const STATUS_DELETED = 0;
    const STATUS_INACTIVE = 2;
    const SCENARIO_FORM = 'form';

    public $categories_list = [];

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
            [['user_id'], 'integer'],
            [['name', 'activity_field', 'activity_description', 'telegram', 'user_id', 'instagram', 'linkedin', 'twitter', 'whatsapp', 'consultation_face_to_face_status', 'consultation_online_status'], 'required', 'on' => [self::SCENARIO_FORM]],
            [['activity_description', 'telegram', 'name'], 'string'],
            [['instagram', 'linkedin', 'twitter', 'whatsapp', 'telegram', 'activity_field'], 'string', 'max' => 255],
            [['consultation_face_to_face_cost', 'consultation_online_cost'], 'number'],
            [['picture', 'picture_mentor'], 'image', 'extensions' => ['jpg', 'jpeg', 'png'], 'skipOnEmpty' => true],
            [['video'], 'file', 'extensions' => ['mp4', 'avi'], 'skipOnEmpty' => true],
        ];
    }

    public function scenarios()
    {
        $scenarios = parent::scenarios();
        $scenarios[self::SCENARIO_FORM] = ['name', 'activity_field', 'activity_description', 'telegram', 'user_id', 'instagram', 'linkedin', 'twitter', 'whatsapp', 'consultation_face_to_face_status', 'consultation_face_to_face_cost', 'consultation_online_cost', 'consultation_online_status', 'user_id'];
        return $scenarios;
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'picture' => Yii::t('app', 'Picture'),
            'video' => Yii::t('app', 'Video'),
            'instagram' => Yii::t('app', 'Instagram'),
            'linkedin' => Yii::t('app', 'Linkedin'),
            'twitter' => Yii::t('app', 'Twitter'),
            'status' => Yii::t('app', 'Status'),
            'user_id' => Yii::t('app', 'User ID'),
            'whatsapp' => Yii::t('app', 'Whatsapp'),
            'telegram' => Yii::t('app', 'Telegram'),
            'activity_field' => Yii::t('app', 'Activity Field'),
            'activity_description' => Yii::t('app', 'Activity Description'),
            'services' => Yii::t('app', 'Services'),
            'consultation_online_status' => Yii::t('app', 'Consultation Online Status'),
            'consultation_face_to_face_cost' => Yii::t('app', 'Consultation Face To Face Cost'),
            'name' => Yii::t('app', 'Name'),
            'consultation_online_cost' => Yii::t('app', 'Consultation Online Cost'),
            'consultation_face_to_face_status' => Yii::t('app', 'Consultation Face To Face Status'),
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
        return $query->notDeleted();
    }

    public function canDelete()
    {
        return $this->mentorsAdviceRequests;
    }

    public function getMentorCategories(): ActiveQuery
    {
        return $this->hasMany(MentorCategories::class, ['mentor_id' => 'id']);
    }

    public function getMentorsAdviceRequests(): ActiveQuery
    {
        return $this->hasMany(MentorsAdviceRequest::class, ['mentor_id' => 'id']);
    }

    public function getMentorServices()
    {
        return $this->hasMany(MentorServices::class, ['mentor_id' => 'id']);
    }

    public static function itemAlias($type, $code = NULL)
    {
        $_items = [
            'Status' => [
                self::STATUS_DELETED => Yii::t('app', 'DELETED'),
                self::STATUS_ACTIVE => Yii::t('app', 'ACTIVE'),
                self::STATUS_INACTIVE => Yii::t('app', 'INACTIVE'),
            ]
        ];
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
                    'status' => [self::STATUS_ACTIVE, self::STATUS_INACTIVE]

                ],
                'replaceRegularDelete' => false, // mutate native `delete()` method
                'invokeDeleteEvents' => false
            ],
            [
                'class' => CdnUploadImageBehavior::class,
                'attribute' => 'picture',
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
            [
                'class' => CdnUploadImageBehavior::class,
                'attribute' => 'picture_mentor',
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
            [
                'class' => CdnUploadImageBehavior::class,
                'attribute' => 'video',
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
            ]
        ];
    }


    public function extraFields()
    {
        return [];
    }
}