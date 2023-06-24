<?php

namespace common\models;

use common\traits\AjaxValidationTrait;
use common\traits\CoreTrait;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\TimestampBehavior;
use yii2tech\ar\softdelete\SoftDeleteBehavior;

/**
 * This is the model class for table "ince_event_time".
 *
 * @property int $id
 * @property int $event_id
 * @property int|null $start_at
 * @property int|null $end_at
 * @property int|null $updated_by
 * @property int|null $updated_at
 * @property int|null $created_at
 * @property int|null $created_by
 * @property int $deleted_at
 *
 * @property Event $event
 */
class EventTime extends \yii\db\ActiveRecord
{
    const STATUS_ACTIVE = 1;
    const STATUS_DELETED = 0;
    const STATUS_INACTIVE = 2;
    use CoreTrait;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'ince_event_time';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['start_at', 'end_at'], 'validateEndTime'],
            [['start_at', 'end_at'], 'required'],
            [['event_id'], 'exist', 'skipOnError' => true, 'targetClass' => Event::class, 'targetAttribute' => ['event_id' => 'id']],
        ];
    }

    public function validateEndTime($attribute, $params)
    {
        if(isset($this->start_at) and isset($this->end_at)){
            $start_at = $this->jalaliToTimestamp($this->start_at,"Y/m/d H:i");
            $end_at = $this->jalaliToTimestamp($this->end_at,"Y/m/d H:i");
            if ($end_at <= $start_at) {
                $this->addError($attribute, 'End time must be greater than the start time.');
            }
        }
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'event_id' => 'Event ID',
            'start_at' => 'Start At',
            'end_at' => 'End At',
            'updated_by' => 'Updated By',
            'updated_at' => 'Updated At',
            'created_at' => 'Created At',
            'created_by' => 'Created By',
            'deleted_at' => 'Deleted At',
        ];
    }

    /**
     * Gets query for [[Event]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getEvent()
    {
        return $this->hasOne(Event::class, ['id' => 'event_id']);
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
        ];
    }
}
