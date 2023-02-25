<?php

namespace common\models;

use common\behaviors\CdnUploadImageBehavior;
use Yii;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\TimestampBehavior;
use yii2tech\ar\softdelete\SoftDeleteBehavior;

/**
 * This is the model class for table "{{%mentors_advice_request}}".
 *
 * @property int $id
 * @property int $user_id
 * @property int $mentor_id
 * @property string $description
 * @property string $date_advice
 * @property int $type
 * @property string $file
 * @property int $status
 * @property int $deleted_at
 * @property int $updated_by
 * @property int $updated_at
 * @property int $created_at
 * @property int $created_by
 *
 * @property User $createdBy
 * @property Mentor $mentor
 * @property User $updatedBy
 * @property User $user
 */
class MentorsAdviceRequest extends \yii\db\ActiveRecord
{
    const STATUS_FACE_TO_FACE = 1;
    const STATUS_ONLINE = 0;
    /**
     * {@inheritdoc}
     */


    public static function tableName()
    {
        return '{{%mentors_advice_request}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'mentor_id', 'description', 'date_advice', 'type', 'status','file'], 'required'],
            [['user_id', 'mentor_id', 'type', 'status', 'deleted_at', 'updated_by', 'updated_at', 'created_at', 'created_by'], 'integer'],
            [['description'], 'string'],
            [['date_advice'], 'string', 'max' => 255],
            ['file', 'file','maxSize' => 1024 * 1024 * 3],
            [['mentor_id'], 'exist', 'skipOnError' => true, 'targetClass' => Mentor::class, 'targetAttribute' => ['mentor_id' => 'id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['user_id' => 'id']],
            [['created_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['created_by' => 'id']],
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
            'user_id' => Yii::t('app', 'User ID'),
            'mentor_id' => Yii::t('app', 'Mentor ID'),
            'description' => Yii::t('app', 'Description'),
            'date_advice' => Yii::t('app', 'Date Advice'),
            'type' => Yii::t('app', 'Type'),
            'file' => Yii::t('app', 'File'),
            'status' => Yii::t('app', 'Status'),
            'deleted_at' => Yii::t('app', 'Deleted At'),
            'updated_by' => Yii::t('app', 'Updated By'),
            'updated_at' => Yii::t('app', 'Updated At'),
            'created_at' => Yii::t('app', 'Created At'),
            'created_by' => Yii::t('app', 'Created By'),
        ];
    }
    public static function itemAlias($type, $code = NULL)
    {
        $_items = [
            'TYPE' => [
                self::STATUS_FACE_TO_FACE => Yii::t('app', 'FACE_TO_FACE'),
                self::STATUS_ONLINE => Yii::t('app', 'ONLINE'),
            ],
        ];
        if (isset($code))
            return isset($_items[$type][$code]) ? $_items[$type][$code] : false;
        else
            return isset($_items[$type]) ? $_items[$type] : false;
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
     * Gets query for [[Mentor]].
     *
     * @return \yii\db\ActiveQuery|MentorQuery
     */
    public function getMentor()
    {
        return $this->hasOne(Mentor::class, ['id' => 'mentor_id']);
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
     * @return MentorsAdviceRequestQuery the active query used by this AR class.
     */
    public static function find()
    {
        $query = new MentorsAdviceRequestQuery(get_called_class());
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
                'attribute' => 'file',
                'scenarios' => [self::SCENARIO_DEFAULT],
                'instanceByName' => false,
                //'placeholder' => "/assets/images/default.jpg",
                'deleteBasePathOnDelete' => false,
                'createThumbsOnSave' => false,
                'transferToCDN' => false,
                'cdnPath' => "@cdnRoot/MentorsAdviceRequest",
                'basePath' => "@inceRoot/MentorsAdviceRequest",
                'path' => "@inceRoot/MentorsAdviceRequest",
                'url' => "@cdnWeb/MentorsAdviceRequest"
            ],
        ];
    }

    public function fields()
    {
        return [
            'id',
            'user_id',
            'mentor_id',
            'description',
            'date_advice',
            'type',
            'file',
            'status',
        ];
    }

    public function extraFields()
    {
        return [];
    }
}
