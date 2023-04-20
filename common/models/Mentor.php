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
 */
class Mentor extends \yii\db\ActiveRecord
{
    public $picture_mentor;



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
            [['user_id', 'name', 'activity_field', 'activity_description'], 'required'],
            [['activity_description','resume_file'], 'string'],
            [[ 'services', 'records'], 'safe'],
            [['status', 'user_id', 'updated_by', 'created_at', 'created_by', 'updated_at', 'deleted_at'], 'integer'],
            [['instagram', 'linkedin', 'twitter', 'whatsapp', 'telegram', 'activity_field'], 'string', 'max' => 255],
            [['updated_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['updated_by' => 'id']],
        ];
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

    public function getMentorCategories()
    {
        return $this->hasMany(FreelancerCategories::class, ['freelancer_id' => 'id'])->where(['model_class'=>Mentor::className()]);
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
                'attribute' => 'picture',
                'scenarios' => [self::SCENARIO_DEFAULT],
                'instanceByName' => false,
                //'placeholder' => "/assets/images/default.jpg",
                'deleteBasePathOnDelete' => false,
                'createThumbsOnSave' => false,
                'transferToCDN' => true,
                'cdnPath' => "@cdnRoot/mentor",
                'basePath' => "@inceRoot/mentor",
                'path' => "@inceRoot/mentor",
                'url' => "@cdnWeb/mentor"
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
                'transferToCDN' => true,
                'cdnPath' => "@cdnRoot/mentor",
                'basePath' => "@inceRoot/mentor",
                'path' => "@inceRoot/mentor",
                'url' => "@cdnWeb/mentor"
            ]
        ];
    }


    public function extraFields()
    {
        return [];
    }
}