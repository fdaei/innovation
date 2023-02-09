<?php

namespace common\models;

use common\behaviors\CdnUploadImageBehavior;
use Yii;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\TimestampBehavior;
use yii2tech\ar\softdelete\SoftDeleteBehavior;

/**
 * This is the model class for table "{{%mentors}}".
 *
 * @property int $id
 * @property int $user_id
 * @property string|null $name
 * @property string|null $telegram
 * @property string|null $instagram
 * @property string|null $whatsapp
 * @property string|null $activity_field
 * @property string|null $profile_pic
 * @property string|null $activity_description
 * @property float|null $consulting_fee
 * @property int|null $consultation_face_to_face
 * @property int|null $consultation_online
 * @property string|null $services
 * @property string|null $records
 * @property int $status
 * @property int $updated_at
 * @property int $updated_by
 * @property int $created_by
 * @property int $created_at
 * @property int|null $deleted_at
 */
class Mentors extends \yii\db\ActiveRecord
{

    public $array=[];
    /**
     * {@inheritdoc}
     */
    const STATUS_ACCEPTED = 1;
    const STATUS_NOT_CONFIRMED = 0;



    public static function tableName()
    {
        return '{{%mentors}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id'], 'required'],
            ['profile_pic', 'image','extensions' => 'jpg, jpeg, png','enableClientValidation' => false],
            [['user_id', 'consultation_face_to_face', 'consultation_online', 'status', 'updated_at', 'updated_by', 'created_by', 'created_at', 'deleted_at'], 'integer'],
            [['activity_description'], 'string'],
            [['consulting_fee'], 'number'],
            [['services', 'records'], 'safe'],
            [['name', 'telegram', 'instagram', 'whatsapp', 'activity_field', 'profile_pic'], 'string', 'max' => 255],
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
            'name' => Yii::t('app', 'Name'),
            'telegram' => Yii::t('app', 'Telegram'),
            'instagram' => Yii::t('app', 'Instagram'),
            'whatsapp' => Yii::t('app', 'Whatsapp'),
            'activity_field' => Yii::t('app', 'Activity Field'),
            'profile_pic' => Yii::t('app', 'Profile Pic'),
            'activity_description' => Yii::t('app', 'Activity Description'),
            'consulting_fee' => Yii::t('app', 'Consulting Fee'),
            'consultation_face_to_face' => Yii::t('app', 'Consultation Face To Face'),
            'consultation_online' => Yii::t('app', 'Consultation Online'),
            'services' => Yii::t('app', 'Services'),
            'records' => Yii::t('app', 'Records'),
            'status' => Yii::t('app', 'Status'),
            'updated_at' => Yii::t('app', 'Updated At'),
            'updated_by' => Yii::t('app', 'Updated By'),
            'created_by' => Yii::t('app', 'Created By'),
            'created_at' => Yii::t('app', 'Created At'),
            'deleted_at' => Yii::t('app', 'Deleted At'),
        ];
    }

    /**
     * {@inheritdoc}
     * @return MentorsQuery the active query used by this AR class.
     */
    public static function find()
    {
        $query = new MentorsQuery(get_called_class());
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
                'attribute' => 'image',
                'instanceByName' => false,
                //'placeholder' => "/assets/images/default.jpg",
                'deleteBasePathOnDelete' => false,
                'createThumbsOnSave' => false,
                'transferToCDN' => false,
                'cdnPath' => "@cdnRoot/Business",
                'basePath' => "@inceRoot/Business",
                'path' => "@inceRoot/Business",
                'url' => "@cdnWeb/Business"
            ],
        ];
    }
    public static function itemAlias($type, $code = NULL)
    {
        $_items = [
            'Status' => [
                self::STATUS_ACCEPTED => Yii::t('app', 'SHARE'),
                self::STATUS_NOT_CONFIRMED => Yii::t('app', 'NOT_SHARE'),
            ],
        ];
        if (isset($code))
            return isset($_items[$type][$code]) ? $_items[$type][$code] : false;
        else
            return isset($_items[$type]) ? $_items[$type] : false;
    }
    public function fields()
    {
        return [
            'id',
            'user_id',
            'name',
            'telegram',
            'instagram',
            'whatsapp',
            'activity_field',
            'profile_pic',
            'activity_description',
            'consulting_fee',
            'consultation_face_to_face',
            'consultation_online',
            'services',
            'records',
            'status',
        ];
    }

    public function extraFields()
    {
        return [];
    }
}