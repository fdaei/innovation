<?php

namespace common\models;

use Yii;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\TimestampBehavior;
use yii\helpers\HtmlPurifier;
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
 * @property BusinessTimeline $businessTimeline
 *
 * @mixin SoftDeleteBehavior
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
        return '{{%business_timeline_item}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['description', 'status'], 'required'],
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
     * @return \yii\db\ActiveQuery|BusinessTimelineQuery
     */
    public function getBusinessTimeline()
    {
        return $this->hasOne(BusinessTimeline::class, ['id' => 'business_timeline_id']);
    }

    public function beforeSave($insert)
    {
        $this->description = HtmlPurifier::process($this->description);

        return parent::beforeSave($insert);
    }

    /**
     * {@inheritdoc}
     * @return BusinessTimelineItemQuery the active query used by this AR class.
     */
    public static function find()
    {
        $query = new BusinessTimelineItemQuery(get_called_class());
        return $query->active();
    }

    public static function itemAlias($type, $code = NULL)
    {
        $_items = [
            'Status' => [
                self::STATUS_DELETED => Yii::t('app', 'DELETED'),
                self::STATUS_ACTIVE => Yii::t('app', 'ACTIVE'),
                self::STATUS_INACTIVE => Yii::t('app', 'INACTIVE'),
            ],
            'StatusClass' => [
                self::STATUS_DELETED => 'danger',
                self::STATUS_ACTIVE => 'success',
                self::STATUS_INACTIVE => 'warning',
            ],
            'StatusColor' => [
                self::STATUS_DELETED => '#ff5050',
                self::STATUS_ACTIVE => '#04AA6D',
                self::STATUS_INACTIVE => '#eea236',
            ],];
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
            'businessTimelineId' => 'business_timeline_id',
            'Description' => 'description',
        ];
    }

    public function extraFields()
    {
        return parent::extraFields(); // TODO: Change the autogenerated stub
    }

    public function canDelete()
    {
        return true;
    }
}