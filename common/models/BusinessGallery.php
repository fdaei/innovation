<?php

namespace common\models;

use common\behaviors\CdnUploadImageBehavior;
use Yii;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\TimestampBehavior;
use yii2tech\ar\softdelete\SoftDeleteBehavior;

/**
 * This is the model class for table "business_gallery".
 *
 * @property int $id
 * @property int $business_id
 * @property string $image
 * @property string $mobile_image
 * @property string $title
 * @property string $description
 * @property int $status
 * @property int $created_at
 * @property int $created_by
 * @property int $updated_at
 * @property int $updated_by
 * @property int $deleted_at
 *
 * @property Business $business
 * @property User $createdBy
 * @property User $updatedBy
 */
class BusinessGallery extends \yii\db\ActiveRecord
{
    const STATUS_ACTIVE = 1;
    const STATUS_DELETED = 0;
    const STATUS_INACTIVE = 2;
    const SCENARIO_UPDATE = 'update';
    const SCENARIO_CREATE = 'create';

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%business_gallery}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['business_id', 'title', 'description', 'image', 'mobile_image','status'], 'required', 'on' => [self::SCENARIO_CREATE]],
            [['business_id', 'title', 'description'], 'required', 'on' => [self::SCENARIO_UPDATE]],
            [['business_id', 'status'], 'integer'],
            [['description'], 'string'],
            [['title'], 'string', 'max' => 255],
            [['image', 'mobile_image'], 'file', 'skipOnEmpty' => false, 'extensions' => ['png', 'jpg'], 'checkExtensionByMimeType' => false],
            ['image', 'image', 'minWidth' => 648, 'maxWidth' => 648, 'minHeight' => 348, 'maxHeight' => 348, 'extensions' => 'jpg, jpeg, png', 'maxSize' => 1024 * 1024 * 2, 'enableClientValidation' => false],
            ['mobile_image', 'image', 'minWidth' => 316, 'maxWidth' => 316, 'minHeight' => 224, 'maxHeight' => 224, 'extensions' => 'jpg, jpeg, png', 'maxSize' => 1024 * 1024 * 2, 'enableClientValidation' => false],
            [['created_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['created_by' => 'id']],
            [['updated_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['updated_by' => 'id']],
            [['business_id'], 'exist', 'skipOnError' => true, 'targetClass' => Business::class, 'targetAttribute' => ['business_id' => 'id']],
        ];
    }

    public function scenarios()
    {
        $scenarios = parent::scenarios();

        $scenarios[self::SCENARIO_CREATE] = ['business_id', 'title', 'description','status','image','mobile_image'];
        $scenarios[self::SCENARIO_UPDATE] = ['business_id', 'title', 'description'];

        return $scenarios;
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'business_id' => Yii::t('app', 'Business ID'),
            'image' => Yii::t('app', 'Image'),
            'mobile_image' => Yii::t('app', 'MobileImage'),
            'title' => Yii::t('app', 'Title'),
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
     * Gets query for [[Business]].
     *
     * @return \yii\db\ActiveQuery|BusinessQuery
     */
    public function getBusiness()
    {
        return $this->hasOne(Business::class, ['id' => 'business_id']);
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
     * {@inheritdoc}
     * @return BusinessGalleryQuery the active query used by this AR class.
     */
    public static function find()
    {
        $query = new BusinessGalleryQuery(get_called_class());
        return $query->active();
    }

    public function canDelete()
    {
        return true;
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
            ],
            [
                'class' => CdnUploadImageBehavior::class,
                'attribute' => 'image',
                'scenarios' => [self::SCENARIO_CREATE,self::SCENARIO_UPDATE],
                'instanceByName' => false,
                //'placeholder' => "/assets/images/default.jpg",
                'deleteBasePathOnDelete' => false,
                'createThumbsOnSave' => false,
                'transferToCDN' => false,
                'cdnPath' => "@cdnRoot/Business",
                'basePath' => "@inceRoot/Business",
                'path' => "@inceRoot/Business",
                'url' => "@cdnWeb/Business"
            ],
            [
                'class' => CdnUploadImageBehavior::class,
                'attribute' => 'mobile_image',
                'scenarios' => [self::SCENARIO_CREATE,self::SCENARIO_UPDATE],
                'instanceByName' => false,
                //'placeholder' => "/assets/images/default.jpg",
                'deleteBasePathOnDelete' => false,
                'createThumbsOnSave' => false,
                'transferToCDN' => false,
                'cdnPath' => "@cdnRoot/Business",
                'basePath' => "@inceRoot/Business",
                'path' => "@inceRoot/Business",
                'url' => "@cdnWeb/Business"
            ],
        ];
    }

    public function fields()
    {
        return [
            'id' => 'id',
            'business_id' => 'business_id',
            'title' => 'title',
            'description' => 'description',
            'image' => function (self $model) {
                return $model->getUploadUrl('image');
            },
            'mobile_image' => function (self $model) {
                return $model->getUploadUrl('mobile_image');
            },
        ];
    }

    public function extraFields()
    {
        return parent::extraFields(); // TODO: Change the autogenerated stub
    }

}