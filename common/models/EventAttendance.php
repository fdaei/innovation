<?php

namespace common\models;

use Yii;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\TimestampBehavior;
use yii2tech\ar\softdelete\SoftDeleteBehavior;

/**
 * This is the model class for table "{{%event_attendance}}".
 *
 * @property int $id
 * @property int|null $event_id
 * @property int|null $user_id
 * @property string|null $first_name
 * @property string|null $last_name
 * @property string|null $mobile
 * @property string|null $email
 * @property string|null $description
 * @property int $status
 * @property int|null $updated_by
 * @property int|null $updated_at
 * @property int|null $created_at
 * @property int|null $created_by
 * @property int $deleted_at
 *
 * @property User $createdBy
 * @property Event $event
 * @property User $updatedBy
 * @property User $user
 *
 * @mixin SoftDeleteBehavior
 */
class EventAttendance extends \yii\db\ActiveRecord
{
    const STATUS_DELETED = 0;
    const STATUS_WAITING = 1;
    const STATUS_CONFIRM = 2;
    const STATUS_REJECT = 3;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%event_attendance}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['event_id', 'user_id', 'status', 'updated_by', 'updated_at', 'created_at', 'created_by', 'deleted_at'], 'integer'],
            [['description'], 'string', 'max' => 512],
            [['first_name'], 'string', 'max' => 64],
            [['last_name'], 'string', 'max' => 128],
            [['mobile'], 'string', 'max' => 11],
            [['event_id', 'first_name', 'last_name', 'mobile', 'status'], 'required'],
            [['mobile'], 'match', 'pattern' => '^09[0-9]{9}$^'],
            [['email'], 'match', 'pattern' => '/^[a-zA-Z0-9!#$%&\'*+\/=?^_`{|}~-]+(?:\.[a-zA-Z0-9!#$%&\'*+\/=?^_`{|}~-]+)*@(?:[a-zA-Z0-9](?:[a-zA-Z0-9-]*[a-zA-Z0-9])?\.)+[a-zA-Z0-9](?:[a-zA-Z0-9-]*[a-zA-Z0-9])?$/'],
            [['first_name', 'last_name', 'mobile', 'email'], 'string', 'max' => 255],
            [['event_id'], 'exist', 'skipOnError' => true, 'targetClass' => Event::class, 'targetAttribute' => ['event_id' => 'id']],
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
            'event_id' => Yii::t('app', 'Event ID'),
            'user_id' => Yii::t('app', 'User ID'),
            'first_name' => Yii::t('app', 'First Name'),
            'last_name' => Yii::t('app', 'Last Name'),
            'mobile' => Yii::t('app', 'Mobile'),
            'email' => Yii::t('app', 'Email'),
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
     * Gets query for [[CreatedBy]].
     *
     * @return \yii\db\ActiveQuery|yii\db\ActiveQuery
     */
    public function getCreatedBy()
    {
        return $this->hasOne(User::class, ['id' => 'created_by']);
    }

    /**
     * Gets query for [[Event]].
     *
     * @return \yii\db\ActiveQuery|EventQuery
     */
    public function getEvent()
    {
        return $this->hasOne(Event::class, ['id' => 'event_id']);
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
     * @return EventAttendanceQuery the active query used by this AR class.
     */
    public static function find()
    {
        $query = new EventAttendanceQuery(get_called_class());
        return $query->notDeleted();
    }

    /**
     * @param $insert
     * @return bool
     */
    public function beforeSave($insert)
    {
        if ($insert) {
            $this->user_id = Yii::$app->user->identity?->id;
        }

        return parent::beforeSave($insert);
    }

    public static function itemAlias($type, $code = NULL)
    {
        $_items = [
            'Status' => [
                self::STATUS_DELETED => Yii::t('app', 'DELETED'),
                self::STATUS_WAITING => Yii::t('app', 'WAITING'),
                self::STATUS_CONFIRM => Yii::t('app', 'CONFIRM'),
                self::STATUS_REJECT => Yii::t('app', 'REJECT'),
            ],
        ];
        if (isset($code))
            return isset($_items[$type][$code]) ? $_items[$type][$code] : false;
        else
            return isset($_items[$type]) ? $_items[$type] : false;
    }

    /**
     * @return array
     */
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
                    'status' => [self::STATUS_CONFIRM, self::STATUS_WAITING, self::STATUS_REJECT]
                ],
                'replaceRegularDelete' => false, // mutate native `delete()` method
                'invokeDeleteEvents' => false
            ],
        ];
    }

    /**
     * @return array
     */
    public function fields()
    {
        return [
            'id',
            'eventId' => 'event_id',
            'status' => function (self $model) {
                return [
                    'code' => $model->status,
                    'title' => self::itemAlias('Status', $model->status),
                ];
            },
            'firstName' => 'first_name',
            'lastName' => 'last_name',
            'mobile',
            'description',
            'createdAt' => function (self $model) {
                return Yii::$app->pdate->jdate('Y/m/d', $model->created_at);
            },
            'updatedAt' => function (self $model) {
                return Yii::$app->pdate->jdate('Y/m/d', $model->updated_at);
            },
        ];
    }

    public function extraFields()
    {
        return [
            'user',
            'event'
        ];
    }
}