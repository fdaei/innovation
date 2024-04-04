<?php

namespace common\models;

use common\traits\CoreTrait;
use Yii;
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
 * @mixin TimestampBehavior
 * @mixin BlameableBehavior
 * @mixin SoftDeleteBehavior
 */
class EventTime extends \yii\db\ActiveRecord
{
    use CoreTrait;

    const STATUS_DELETED = 0;
    const STATUS_ACTIVE = 1;
    const STATUS_INACTIVE = 2;

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
    public function beforeValidate()
    {
        $this->start_at = $this->jalaliToTimestamp($this->start_at, "Y/m/d H:i");
        $this->end_at = $this->jalaliToTimestamp($this->end_at, "Y/m/d H:i");
        return parent::beforeValidate();
    }
    public function validateEndTime($attribute, $params)
    {
        if (isset($this->start_at) && isset($this->end_at)) {
            $start_at = $this->start_at;
            $end_at = $this->end_at;
            if ($end_at <= $start_at) {
                $this->addError($attribute, 'End time must be greater than the start time.');
            }
        }
    }
    /**
     * Gets query for [[Event]].
     *
     * @return \yii\db\ActiveQuery|\yii\db\ActiveQuery
     */
    public function getEvent()
    {
        return $this->hasOne(Event::class, ['id' => 'event_id']);
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
    public static function itemAlias($type, $code = NULL)
    {
        $_items = [
            'Status' => [
                self::STATUS_DELETED => Yii::t('app', 'DELETED'),
                self::STATUS_ACTIVE => Yii::t('app', 'ACTIVE'),
                self::STATUS_INACTIVE => Yii::t('app', 'INACTIVE'),
            ],
            'Filter' => [
                EventSearch::FILTER_COMING_SOON => Yii::t('app', 'Coming Soon'),
                EventSearch::FILTER_RUNNING => Yii::t('app', 'Running'),
                EventSearch::FILTER_PASSED => Yii::t('app', 'Passed'),
            ]
        ];
        if (isset($code))
            return isset($_items[$type][$code]) ? $_items[$type][$code] : false;
        else
            return isset($_items[$type]) ? $_items[$type] : false;
    }
    /**
     * Gets query for [[Event]].
     *
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
                    'status' => self::STATUS_DELETED
                ],
                'restoreAttributeValues' => [
                    'deleted_at' => 0,
                    'status' => self::STATUS_ACTIVE
                ],
                'replaceRegularDelete' => false,
                'invokeDeleteEvents' => false
            ],
        ];
    }

}