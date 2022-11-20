<?php

namespace common\models;

use common\behaviors\CdnUploadImageBehavior;
use Yii;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\TimestampBehavior;
use yii2tech\ar\softdelete\SoftDeleteBehavior;

/**
 * This is the model class for table "ince_business_timeline_item".
 *
 * @property int $id
 * @property int $business_timeline_id
 * @property string $description
 * @property int $status
 * @property int $created_at
 * @property int $created_by
 * @property int $updated_at
 * @property int $updated_by
 * @property int $deleted_at
 *
 * @property BusinessTimelineItem $businessTimeline
 * @property BusinessTimelineItem[] $businessTimelineItems
 */
class BusinessTimelineItem extends \yii\db\ActiveRecord
{
    const STATUS_ACTIVE = 1;
    const STATUS_DELETED = 0;
    const STATUS_INACTIVE = 2;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return  '{{%business_timeline_item}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['description','status'],'required'],
            [['description'], 'string'],
            [['business_timeline_id'], 'exist', 'skipOnError' => true, 'targetClass' => BusinessTimeline::class, 'targetAttribute' => ['business_timeline_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'business_timeline_id' => Yii::t('app', 'Business Timeline ID'),
            'description' => Yii::t('app', 'Description'),
            'status' => Yii::t('app', 'Status'),
            'created_at' => Yii::t('app', 'Created At'),
            'created_by' => Yii::t('app', 'Created By'),
            'updated_at' => Yii::t('app', 'Updated At'),
            'updated_by' => Yii::t('app', 'Updated By'),
            'deleted_at' => Yii::t('app', 'Deleted At'),
        ];
    }

    /**
     * Gets query for [[BusinessTimeline]].
     *
     * @return \yii\db\ActiveQuery|BusinessTimelineItemQuery
     */
    /**
     * Gets query for [[BusinessTimelineItems]].
     *
     * @return \yii\db\ActiveQuery|BusinessTimelineItemQuery
     */
    public function getBusinessTimelineItems()
    {
       return $this->hasMany(BusinessTimelineItem::class, ['business_timeline_id' => 'id']);

    }

    /**
     * {@inheritdoc}
     * @return BusinessTimelineItemQuery the active query used by this AR class.
     */
    public static function find()
    {
        $query =  new BusinessTimelineItemQuery(get_called_class());
        return $query->active();
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
            ]
        ];
    }

    public function fields()
    {
        return [
            'id',
            'businessTimelineId'=>'business_timeline_id',
            'Description'=>'description',
        ];
    }

    public function extraFields()
    {
        return [
        ];
    }
}