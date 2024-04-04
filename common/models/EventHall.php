<?php

namespace common\models;

use Yii;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\TimestampBehavior;
use yii2tech\ar\softdelete\SoftDeleteBehavior;

/**
 * This is the model class for table "{{%event_hall}}".
 *
 * @property int $id
 * @property int $branche_id
 * @property string $name
 * @property float $longitude
 * @property float $latitude
 * @property int $capacity
 * @property string|null $description
 * @property string|null $rules
 * @property string $specifications
 * @property int $updated_by
 * @property int $updated_at
 * @property int $created_at
 * @property int $created_by
 * @property int $deleted_at
 *
 * @property Branches $branche
 * @property User $createdBy
 * @property EventHallPriceList[] $eventHallPriceLists
 * @property User $updatedBy
 *
 * @mixin TimestampBehavior
 * @mixin BlameableBehavior
 * @mixin SoftDeleteBehavior
 */
class EventHall extends \yii\db\ActiveRecord
{



    /**
     * {@inheritdoc}
     */

    public static function tableName()
    {
        return '{{%event_hall}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [[ 'name', 'longitude', 'latitude', 'capacity', 'specifications'], 'required'],
            [[ 'capacity'], 'integer'],
            [['longitude', 'latitude'], 'number'],
            [['description', 'rules'], 'string'],
            [['specifications'], 'safe'],
            [['name'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'branche_id' => Yii::t('app', 'Branche ID'),
            'name' => Yii::t('app', 'Name'),
            'longitude' => Yii::t('app', 'Longitude'),
            'latitude' => Yii::t('app', 'Latitude'),
            'capacity' => Yii::t('app', 'Capacity'),
            'description' => Yii::t('app', 'Description'),
            'rules' => Yii::t('app', 'Rules'),
            'specifications' => Yii::t('app', 'Specifications'),
        ];
    }


    /**
     * Gets query for [[Branche]].
     *
     * @return \yii\db\ActiveQuery|BranchesQuery
     */
    public function getBranche()
    {
        return $this->hasOne(Branches::class, ['id' => 'branche_id']);
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
     * Gets query for [[EventHallPriceLists]].
     *
     * @return \yii\db\ActiveQuery|EventHallPriceListQuery
     */
    public function getEventHallPriceLists()
    {
        return $this->hasMany(EventHallPriceList::class, ['event_hall_id' => 'id']);
    }
    public function getEventHallReserved()
    {
        return $this->hasMany(EventHallReserved::class, ['event_hall_id' => 'id']);
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
     * @return EventHallQuery the active query used by this AR class.
     */
    public static function find()
    {
        $query = new EventHallQuery(get_called_class());
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

    public function fields()
    {
        return [
            'branche_id',
            'name',
            'longitude',
            'latitude',
            'capacity',
            'description',
            'rules',
            'specifications',
        ];
    }

    public function extraFields()
    {
        return [];
    }
}
