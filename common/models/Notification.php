<?php

namespace common\models;

use Yii;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\TimestampBehavior;
use yii2tech\ar\softdelete\SoftDeleteBehavior;

/**
 * This is the model class for table "{{%notification}}".
 *
 * @property int $id
 * @property int $user_id
 * @property string $receiver
 * @property int $type
 * @property string $text
 * @property int $created_at
 * @property int $created_by
 * @property int $updated_at
 * @property int $updated_by
 * @property int $deleted_at
 * @property int|null $response
 * @property int $priority
 * @property int|null $send_at
 * @property int $status
 *
 * @property User $createdBy
 * @property User $updatedBy
 * @property User $user
 */
class Notification extends \yii\db\ActiveRecord
{

    /**
     * {@inheritdoc}
     */
    const STATUS_SHARE = 1;
    const STATUS_NOT_SHARE = 0;
    const TYPE_SMS = 1;
    const TYPE_EMAIL=0;


    public static function tableName()
    {
        return '{{%notification}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id','receiver','type', 'text'], 'required'],
            [['user_id', 'type', 'created_at', 'created_by', 'updated_at', 'updated_by', 'deleted_at', 'response', 'priority', 'send_at', 'status'], 'integer'],
            [['text'], 'string'],
            [['receiver'], 'string', 'max' => 255],
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
            'user_id' => Yii::t('app', 'User ID'),
            'receiver' => Yii::t('app', 'Receiver'),
            'type' => Yii::t('app', 'Type'),
            'text' => Yii::t('app', 'Text'),
            'created_at' => Yii::t('app', 'Created At'),
            'created_by' => Yii::t('app', 'Created By'),
            'updated_at' => Yii::t('app', 'Updated At'),
            'updated_by' => Yii::t('app', 'Updated By'),
            'deleted_at' => Yii::t('app', 'Deleted At'),
            'response' => Yii::t('app', 'Response'),
            'priority' => Yii::t('app', 'Priority'),
            'send_at' => Yii::t('app', 'Send At'),
            'status' => Yii::t('app', 'Status'),
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
     * @return NotificationQuery the active query used by this AR class.
     */
    public static function find()
    {
        $query = new NotificationQuery(get_called_class());
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
        ];
    }
    public static function itemAlias($type, $code = NULL)
    {
        $_items = [
            'Status' => [
                self::STATUS_SHARE => Yii::t('app', 'SHARE'),
                self::STATUS_NOT_SHARE => Yii::t('app', 'NOT_SHARE'),
            ],
            'Type'=>[
                self::TYPE_SMS => Yii::t('app', 'SMS'),
                self::TYPE_EMAIL => Yii::t('app', 'EMAIL'),
            ]
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
            'receiver',
            'type',
            'text',
            'created_at',
            'created_by',
            'updated_at',
            'updated_by',
            'update_at',
            'response',
            'priority',
            'send_at',
            'status',
        ];
    }

    public function extraFields()
    {
        return [];
    }
    public static function Create($user_id,$reciver,$text,$type,$priority=1,$status=0){
        $model = new Notification();
        $model->user_id=$user_id;
        $model->text=$text;
        $model->type=$type;
        $model->priority=$priority;
        $model->receiver=$reciver;
        $model->status=$status;
        if($model->validate()){
            $model->save(false);
            return true;
        }else{
            return false;
        }
    }
}
