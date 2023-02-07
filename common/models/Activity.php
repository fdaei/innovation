<?php

namespace common\models;

use Yii;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\TimestampBehavior;
use yii2tech\ar\softdelete\SoftDeleteBehavior;

/**
 * This is the model class for table "{{%Activity}}".
 *
 * @property int $id
 * @property string $title
 * @property int $status
 * @property int $created_by
 * @property int $updated_by
 * @property int $created_at
 * @property int $updated_at
 * @property int|null $deleted_at
 *
 * @property User $createdBy
 * @property ActivityComment[] $ActivityComments
 */
class Activity extends \yii\db\ActiveRecord
{

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%activity}}';
    }
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title'], 'required'],
            [['send_sms', 'send_email', 'status', 'created_by', 'updated_by', 'created_at', 'updated_at', 'deleted_at'], 'integer'],
            [['title'], 'string', 'max' => 256],
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
            'title' => Yii::t('app', 'Title'),
            'send_sms' => Yii::t('app', 'Send Sms'),
            'send_email' => Yii::t('app', 'Send Email'),
            'status' => Yii::t('app', 'Status'),
            'created_by' => Yii::t('app', 'Created By'),
            'updated_by' => Yii::t('app', 'Updated By'),
            'created_at' => Yii::t('app', 'Created At'),
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
    public function getUpadatedBy()
    {
        return $this->hasOne(User::class, ['id' => 'updated_by']);
    }
    /**
     * Gets query for [[ActivityComments]].
     *
     * @return \yii\db\ActiveQuery|ActivityCommentQuery
     */
    public function getActivityComments()
    {
        return $this->hasMany(ActivityComment::class, ['activity_id' => 'id']);
    }
    /**
     * Gets query for [[ActivityUserAssignments]].
     *
     * @return \yii\db\ActiveQuery|ActivityUserAssignmentQuery
     */
    public function getActivityUserAssignments()
    {
        return $this->hasMany(ActivityUserAssignment::class, ['activity_id' => 'id']);
    }

    /**
     * {@inheritdoc}
     * @return ActivityQuery the active query used by this AR class.
     */
    public static function find()
    {
        $query = new ActivityQuery(get_called_class());
        return $query->active();
    }

    public function canDelete()
    {
        return true;
    }
    public static function itemAlias($type, $code = NULL)
    {
        $_items = [
            'Status' => Statuses::find()->all(),
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
                ],
                'restoreAttributeValues' => [
                    'deleted_at' => 0,
                ],
                'replaceRegularDelete' => false, // mutate native `delete()` method
                'invokeDeleteEvents' => false
            ],
        ];
    }
    public function status(){
        Statuses::find()->all();
    }
    public function fields()
    {
        return [
            'id' ,
            'title' ,
            'send_sms' ,
            'send_email' ,
            'status' ,
        ];
    }

    public function extraFields()
    {
        return [];
    }
}
