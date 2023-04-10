<?php

namespace common\models;

use backend\models\EventHeadlines;
use backend\models\EventTimes;
use common\behaviors\CdnUploadImageBehavior;
use Yii;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\TimestampBehavior;
use yii\helpers\ArrayHelper;
use yii\web\UploadedFile;
use yii2tech\ar\softdelete\SoftDeleteBehavior;

/**
 * This is the model class for table "{{%event}}".
 *
 * @property int $id
 * @property int $event_organizer_id
 * @property string $title
 * @property string $title_brief
 * @property float $price
 * @property float $price_before_discount
 * @property string $description
 * @property string $headlines
 * @property string $evand_link
 * @property string $event_times
 * @property string $address
 * @property float $longitude
 * @property float $latitude
 * @property string $sponsors
 * @property int $updated_at
 * @property int $updated_by
 * @property int $created_at
 * @property int $created_by
 * @property int $deleted_at
 *
 * @property User $createdBy
 * @property User $updatedBy
 */
class Event extends \yii\db\ActiveRecord
{

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
            [['event_organizer_id','title', 'price', 'price_before_discount', 'description', 'address', 'longitude', 'latitude','evand_link','title_brief'], 'required'],
            [['description', 'address','evand_link'], 'string'],
            [['headlines', 'event_times', 'sponsors'], 'safe'],
            [['title'], 'string', 'max' => 255],
            [['price','longitude', 'latitude', 'price_before_discount'], 'filter', 'filter' => function ($number) {
                return Yii::$app->customHelper->toEn($number);
            }],
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
            'price' => Yii::t('app', 'Price'),
            'price_before_discount' => Yii::t('app', 'Price Before Discount'),
            'description' => Yii::t('app', 'Description'),
            'headlines' => Yii::t('app', 'Headlines'),
            'event_times' => Yii::t('app', 'Event Times'),
            'address' => Yii::t('app', 'Address'),
            'longitude' => Yii::t('app', 'Longitude'),
            'latitude' => Yii::t('app', 'Latitude'),
            'sponsors' => Yii::t('app', 'Sponsors'),
            'updated_at' => Yii::t('app', 'Updated At'),
            'updated_by' => Yii::t('app', 'Updated By'),
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
     * {@inheritdoc}
     * @return EventQuery the active query used by this AR class.
     */
    public static function find()
    {
        $query = new EventQuery(get_called_class());
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
            [
                'class' => CdnUploadImageBehavior::class,
                'attribute' => 'picture',
                'scenarios' => [self::SCENARIO_DEFAULT],
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

    public function extraFields()
    {
        return [];
    }
    public function getSponsor()
    {
        return array_map(function ($model){
            if(!empty($model['pic'])){
                $model['pic'] = Yii::getAlias('@cdnWeb/event/' . $model['pic']);
            }
            return $model;
        },$this->sponsors);
    }

    public static function getOrganizerList(){
        return EventOrganizer::find()->all();
    }
}