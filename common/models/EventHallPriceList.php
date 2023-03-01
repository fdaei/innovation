<?php

namespace common\models;

use Yii;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\TimestampBehavior;
use yii2tech\ar\softdelete\SoftDeleteBehavior;

/**
 * This is the model class for table "{{%event_hall_price_list}}".
 *
 * @property int $id
 * @property int $event_hall_id
 * @property string $day
 * @property float $price
 * @property int $created_at
 * @property int $created_by
 * @property int $updated_at
 * @property int $updated_by
 * @property int $deleted_at
 *
 * @property User $createdBy
 * @property EventHall $eventHall
 * @property User $updatedBy
 */
class EventHallPriceList extends \yii\db\ActiveRecord
{
    const Monday = 0;
    const Tuesday = 1;
    const Wednesday = 2;
    const Thursday = 3;
    const Friday = 4;
    const Saturday = 5;
    const Sunday = 6;

    /**
     * {@inheritdoc}
     */


    public static function tableName()
    {
        return '{{%event_hall_price_list}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [[ 'day', 'price'], 'required'],
            [['event_hall_id', 'created_at', 'created_by', 'updated_at', 'updated_by', 'deleted_at'], 'integer'],
            [['price'], 'number'],
            [['created_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['created_by' => 'id']],
            [['updated_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['updated_by' => 'id']],
            [['event_hall_id'], 'exist', 'skipOnError' => true, 'targetClass' => EventHall::class, 'targetAttribute' => ['event_hall_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'event_hall_id' => Yii::t('app', 'Event Hall ID'),
            'day' => Yii::t('app', 'Day'),
            'price' => Yii::t('app', 'Price'),
            'created_at' => Yii::t('app', 'Created At'),
            'created_by' => Yii::t('app', 'Created By'),
            'updated_at' => Yii::t('app', 'Updated At'),
            'updated_by' => Yii::t('app', 'Updated By'),
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
     * Gets query for [[EventHall]].
     *
     * @return \yii\db\ActiveQuery|EventHallQuery
     */
    public function getEventHall()
    {
        return $this->hasOne(EventHall::class, ['id' => 'event_hall_id']);
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
     * {@inheritdoc}
     * @return EventHallPriceListQuery the active query used by this AR class.
     */
    public static function find()
    {
        $query = new EventHallPriceListQuery(get_called_class());
        return $query->active();
    }

    public function canDelete()
    {
        return true;
    }
    public static function itemAlias($type, $code = NULL)
    {
        $_items = [
            'Week' => [
                self::Monday => Yii::t('app', 'Monday'),
                self::Tuesday => Yii::t('app', 'Tuesday'),
                self::Wednesday => Yii::t('app', 'Wednesday'),
                self::Thursday => Yii::t('app', 'Thursday'),
                self::Friday => Yii::t('app', 'Friday'),
                self::Saturday => Yii::t('app', 'Saturday'),
                self::Sunday => Yii::t('app', 'Sunday'),
            ],
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

    public function fields()
    {
        return [
            'id',
            'event_hall_id',
            'day',
            'price',
        ];
    }

    public function extraFields()
    {
        return [];
    }
}
