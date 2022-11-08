<?php

namespace backend\models;

use aminbbb92\user\models\User;
use Yii;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\TimestampBehavior;
use yii2tech\ar\softdelete\SoftDeleteBehavior;

/**
 * This is the model class for table "business".
 *
 * @property int $id
 * @property int $user_id
 * @property int $city_id
 * @property string $title
 * @property string $logo
 * @property string $wallpaper
 * @property string $short_description
 * @property string $success_story
 * @property int $status
 * @property int $created_at
 * @property int $created_by
 * @property int $updated_at
 * @property int $updated_by
 * @property int $deleted_at
 *
 * @property BusinessGallery[] $businessGalleries
 * @property BusinessTimeline[] $businessTimelines
 * @property User $createdBy
 * @property User $updatedBy
 * @property User $user
 */
class Business extends \yii\db\ActiveRecord
{
    public $logo;
    public $wallpaper;
    const STATUS_ACTIVE = 1;
    const STATUS_DELETED = 0;
    const STATUS_INACTIVE = 2;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%business}}';
    }
    
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'city_id', 'title','logo','wallpaper','short_description', 'success_story', 'status','created_by', 'updated_by'], 'required'],
            [['user_id', 'city_id', 'status', 'created_by', 'updated_by'], 'integer'],
            [['short_description', 'success_story'], 'string'],
            [['logo',"wallpaper"], 'file', 'skipOnEmpty' => false, 'extensions' => 'png, jpg'],
            [['title', 'logo', 'wallpaper'], 'string', 'max' => 64],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['user_id' => 'id']],
            [['created_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['created_by' => 'id']],
            [['updated_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['updated_by' => 'id']],
        ];
    }
    public function upload()
    {
        if ($this->validate()) {
            $this->logo->saveAs('uploads/' . $this->logo->baseName . '.' . $this->logo->extension);
            $this->wallpaper->saveAs('uploads/' . $this->wallpaper->baseName . '.' . $this->wallpaper->extension);
            return true;
        } else {
            return false;
        }
    }
    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'user_id' => Yii::t('app', 'User ID'),
            'city_id' => Yii::t('app', 'City ID'),
            'title' => Yii::t('app', 'Title'),
            'logo' => Yii::t('app', 'Logo'),
            'wallpaper' => Yii::t('app', 'Wallpaper'),
            'short_description' => Yii::t('app', 'Short Description'),
            'success_story' => Yii::t('app', 'Success Story'),
            'status' => Yii::t('app', 'Status'),
            'created_at' => Yii::t('app', 'Created At'),
            'created_by' => Yii::t('app', 'Created By'),
            'updated_at' => Yii::t('app', 'Updated At'),
            'updated_by' => Yii::t('app', 'Updated By'),
            'deleted_at' => Yii::t('app', 'Deleted At'),
        ];
    }

    /**
     * Gets query for [[BusinessGalleries]].
     *
     * @return \yii\db\ActiveQuery|BusinessGalleryQuery
     */
    public function getBusinessGalleries()
    {
        return $this->hasMany(BusinessGallery::class, ['business_id' => 'id']);
    }

    /**
     * Gets query for [[BusinessTimelines]].
     *
     * @return \yii\db\ActiveQuery|BusinessTimelineQuery
     */
    public function getBusinessTimelines()
    {
        return $this->hasMany(BusinessTimeline::class, ['business_id' => 'id']);
    }

    /**
     * Gets query for [[CreatedBy]].
     *
     * @return \yii\db\ActiveQuery|UserQuery
     */
    public function getCreatedBy()
    {
        return $this->hasOne(User::class, ['id' => 'created_by']);
    }

    /**
     * Gets query for [[UpdatedBy]].
     *
     * @return \yii\db\ActiveQuery|UserQuery
     */
    public function getUpdatedBy()
    {
        return $this->hasOne(User::class, ['id' => 'updated_by']);
    }

    /**
     * Gets query for [[User]].
     *
     * @return \yii\db\ActiveQuery|UserQuery
     */
    public function getUser(): \yii\db\ActiveQuery|UserQuery
    {
        return $this->hasOne(User::class, ['id' => 'user_id']);
    }
    /**
     * Gets query for [[City]].
     *
     * @return \yii\db\ActiveQuery|CityQuery
     */
    public function getCity(): \yii\db\ActiveQuery|CityQuery
    {
        return $this->hasOne(City::class, [ 'id' => 'city_id' ]);
    }
    
    /**
     * {@inheritdoc}
     * @return BusinessQuery the active query used by this AR class.
     */
    public static function find()
    {
        $query = new ProvinceQuery(get_called_class());
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
            ],
        ];
    }

    public function fields()
    {
        return parent::fields(); // TODO: Change the autogenerated stub
    }
    
    public function extraFields()
    {
        return parent::extraFields(); // TODO: Change the autogenerated stub
    }
}