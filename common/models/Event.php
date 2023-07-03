<?php

namespace common\models;

use common\behaviors\CdnUploadImageBehavior;
use common\behaviors\Taggable;
use Yii;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\TimestampBehavior;
use yii2tech\ar\softdelete\SoftDeleteBehavior;

/**
 * This is the model class for table "{{%event}}".
 * @property int $id
 * @property int $event_organizer_id
 * @property string $title
 * @property string|null $title_brief
 * @property float $price
 * @property float $price_before_discount
 * @property string $picture
 * @property string $evand_link
 * @property string|null $event_times
 * @property string $address
 * @property float $longitude
 * @property float $latitude
 * @property int $updated_at
 * @property int $updated_by
 * @property int $created_at
 * @property int $created_by
 * @property int $deleted_at
 * @property int $status
 * @property string|null $headlines
 * @property string $description
 *
 * @property User $createdBy
 * @property EventAttendance[] $eventAttendances
 * @property EventTime[] $eventTimes
 * @property User $updatedBy
 * @property User[] $users
 *
 * @mixin SoftDeleteBehavior
 * @mixin BlameableBehavior
 * @mixin CdnUploadImageBehavior
 * @mixin TimestampBehavior
 * @mixin Taggable
 *
 */
class Event extends \yii\db\ActiveRecord
{
    const STATUS_DELETED = 0;
    const STATUS_ACTIVE = 1;
    const STATUS_INACTIVE = 2;
    const STATUS_HELD = 3;
    const SCENARIO_UPDATE = 'update';
    const SCENARIO_CREATE = 'create';

    /**
     * @var mixed|null
     */

    public static function tableName()
    {
        return '{{%event}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['event_organizer_id', 'title', 'price', 'price_before_discount', 'description', 'address', 'longitude', 'latitude', 'evand_link', 'title_brief','picture'], 'required', 'on' => [self::SCENARIO_CREATE]],
            [['event_organizer_id', 'title', 'price', 'price_before_discount', 'description', 'address', 'longitude', 'latitude', 'evand_link', 'title_brief'], 'required', 'on' => [self::SCENARIO_UPDATE]],
            [['description', 'address', 'evand_link'], 'string'],
            [['headlines', 'sponsors', 'tagNames'], 'safe'],
            [['title'], 'string', 'max' => 255],
            [['price', 'longitude', 'latitude', 'price_before_discount'], 'filter', 'filter' => function ($number) {
                return Yii::$app->customHelper->toEn($number);
            }],
            ['picture', 'image', 'minWidth' => 1180, 'maxWidth' => 1180, 'minHeight' => 504, 'maxHeight' => 504, 'extensions' => 'jpg, jpeg, png', 'maxSize' => 1024 * 1024 * 2, 'enableClientValidation' => false],
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
            'title_brief' => Yii::t('app', 'Title Brief'),
            'event_organizer_id'=>Yii::t('app','Event Organizer'),
            'evand_link'=>Yii::t('app','Evand link'),
            'price' => Yii::t('app', 'Price'),
            'price_before_discount' => Yii::t('app', 'Price Before Discount'),
            'description' => Yii::t('app', 'Description'),
            'headlines' => Yii::t('app', 'Headlines'),
            'address' => Yii::t('app', 'Address'),
            'longitude' => Yii::t('app', 'Longitude'),
            'latitude' => Yii::t('app', 'Latitude'),
            'sponsors' => Yii::t('app', 'Sponsors'),
            'updated_at' => Yii::t('app', 'Updated At'),
            'updated_by' => Yii::t('app', 'Updated By'),
            'created_at' => Yii::t('app', 'Created At'),
            'created_by' => Yii::t('app', 'Created By'),
            'deleted_at' => Yii::t('app', 'Deleted At'),
            'tagNames' => Yii::t('app', 'Tags'),
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

    public function normalizeNumber($value)
    {
        return Yii::$app->customHelper->toEn($value);
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

    public function getOrganizerInfo()
    {
        return $this->hasOne(EventOrganizer::class, ['id' => 'event_organizer_id']);
    }
    /**
     * Gets query for [[EventAttendances]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getEventAttendances()
    {
        return $this->hasMany(EventAttendance::class, ['event_id' => 'id']);
    }

    /**
     * Gets query for [[EventTime]].
     *
     * @return \yii\db\ActiveQuery|EventTime
     */
    public function getEventTimes(): \yii\db\ActiveQuery|EventTime
    {
        return $this->hasMany(EventTime::class, ['event_id' => 'id']);
    }

    public function getEventSponsorsInfo()
    {
        return $this->hasMany(EventSponsors::class, ['event_id' => 'id']);
    }

    public static function getOrganizerList()
    {
        return EventOrganizer::find()->all();
    }

    public static function itemAlias($type, $code = NULL)
    {
        $_items = [
            'Status' => [
                self::STATUS_DELETED => Yii::t('app', 'DELETED'),
                self::STATUS_ACTIVE => Yii::t('app', 'ACTIVE'),
                self::STATUS_INACTIVE => Yii::t('app', 'INACTIVE'),
                self::STATUS_HELD => Yii::t('app', 'HELD'),
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
     * {@inheritdoc}
     * @return EventQuery the active query used by this AR class.
     */
    public static function find()
    {
        $query = new EventQuery(get_called_class());
        return $query->notDeleted();
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
            'taggable' => [
                'class' => Taggable::class,
                'classAttribute' => self::class,
                'deleteTagsScenario' => self::SCENARIO_DEFAULT
            ],
            'softDeleteBehavior' => [
                'class' => SoftDeleteBehavior::class,
                'softDeleteAttributeValues' => [
                    'deleted_at' => time(),
                    'status' => self::STATUS_DELETED
                ],
                'restoreAttributeValues' => [
                    'deleted_at' => 0,
                    'status' => [self::STATUS_ACTIVE, self::STATUS_INACTIVE, self::STATUS_HELD]
                ],
                'replaceRegularDelete' => false, // mutate native `delete()` method
                'invokeDeleteEvents' => false
            ],
            [
                'class' => CdnUploadImageBehavior::class,
                'attribute' => 'picture',
                'scenarios' => [self::SCENARIO_CREATE,self::SCENARIO_UPDATE,self::SCENARIO_DEFAULT],
                'instanceByName' => false,
                //'placeholder' => "/assets/images/default.jpg",
                'deleteBasePathOnDelete' => false,
                'createThumbsOnSave' => false,
                'transferToCDN' => true,
                'cdnPath' => "@cdnRoot/events",
                'basePath' => "@inceRoot/events",
                'path' => "@inceRoot/events",
                'url' => "@cdnWeb/events"
            ],
        ];
    }

    public function fields()
    {
        return [
            'id',
            'title',
            'titleBrief' => 'title_brief',
            'picture' => function (self $model) {
                return $model->getUploadUrl('picture');
            },
            'organizerInfo',
            'price',
            'priceBeforeDiscount' => 'price_before_discount',
            'evandLink' => 'evand_link',
            'description',
            'headlines',
            'address',
            'longitude',
            'latitude',
            'status' => function (self $model) {
                $status = $model->status;
                $expire = true;
                foreach ($model->eventTimes as $time) {
                    $nowDate = time();
                    if ($time->end_at > $nowDate) {
                        $expire = false;
                    }
                }
                $model->status = $expire ? self::STATUS_HELD : $status;
                return [
                    'code' => $model->status,
                    'title' => Event::itemAlias('Status', $model->status),
                ];
            },
            'tags' => function (self $model) {
                return $model->tagsArray;
            },
        ];
    }
    public function extraFields()
    {
        return [
            'eventTimes',
            'sponsors' => 'eventSponsorsInfo',
        ];
    }
}