<?php

namespace common\models;

use common\behaviors\CdnUploadImageBehavior;
use Yii;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\TimestampBehavior;
use yii2tech\ar\softdelete\SoftDeleteBehavior;

/**
 * This is the model class for table "businesses".
 *
 * @property int $id
 * @property string|null $picture_desktop
 * @property string|null $picture_mobile
 * @property string|null $name
 * @property string|null $business_logo
 * @property string|null $business_color
 * @property string|null $business_en_name
 * @property string|null $description_brief
 * @property string|null $description
 * @property string|null $website
 * @property string|null $telegram
 * @property string|null $instagram
 * @property string|null $whatsapp
 * @property string|null $pic_main_desktop
 * @property string|null $pic_main_mobile
 * @property string|null $pic_small1_desktop
 * @property string|null $pic_small1_mobile
 * @property string|null $pic_small2_desktop
 * @property string|null $pic_small2_mobile
 * @property string|null $statistics
 * @property string|null $services
 * @property string|null $investors
 * @property int $status
 * @property int $updated_at
 * @property int $updated_by
 * @property int $created_by
 * @property int $created_at
 * @property int|null $deleted_at
 */
class Businesses extends \yii\db\ActiveRecord
{

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%businesses}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['description'], 'string'],
            [['statistics', 'services', 'investors'], 'safe'],
            [['status','business_color','business_en_name'], 'required'],
            [['status', 'updated_at', 'updated_by', 'created_by', 'created_at', 'deleted_at'], 'integer'],
//            [['name', 'description_brief', 'website', 'telegram', 'instagram', 'whatsapp'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'picture_desktop' => Yii::t('app', 'Picture Desktop'),
            'picture_mobile' => Yii::t('app', 'Picture Mobile'),
            'name' => Yii::t('app', 'Name'),
            'description_brief' => Yii::t('app', 'Description Brief'),
            'description' => Yii::t('app', 'Description'),
            'website' => Yii::t('app', 'Website'),
            'telegram' => Yii::t('app', 'Telegram'),
            'instagram' => Yii::t('app', 'Instagram'),
            'whatsapp' => Yii::t('app', 'Whatsapp'),
            'pic_main_desktop' => Yii::t('app', 'Pic Main Desktop'),
            'pic_main_mobile' => Yii::t('app', 'Pic Main Mobile'),
            'pic_small1_desktop' => Yii::t('app', 'Pic Small1 Desktop'),
            'pic_small1_mobile' => Yii::t('app', 'Pic Small1 Mobile'),
            'pic_small2_desktop' => Yii::t('app', 'Pic Small2 Desktop'),
            'pic_small2_mobile' => Yii::t('app', 'Pic Small2 Mobile'),
            'statistics' => Yii::t('app', 'Statistics'),
            'services' => Yii::t('app', 'Services'),
            'investors' => Yii::t('app', 'Investors'),
            'status' => Yii::t('app', 'Status'),
            'updated_at' => Yii::t('app', 'Updated At'),
            'updated_by' => Yii::t('app', 'Updated By'),
            'created_by' => Yii::t('app', 'Created By'),
            'created_at' => Yii::t('app', 'Created At'),
            'deleted_at' => Yii::t('app', 'Deleted At'),
        ];
    }

    /**
     * {@inheritdoc}
     * @return BusinessesQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new BusinessesQuery(get_called_class());
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
                'attribute' => 'business_logo',
                'scenarios' => [self::SCENARIO_DEFAULT],
                'instanceByName' => false,
                //'placeholder' => "/assets/images/default.jpg",
                'deleteBasePathOnDelete' => false,
                'createThumbsOnSave' => false,
                'transferToCDN' => true,
                'cdnPath' => "@cdnRoot/businesses",
                'basePath' => "@inceRoot/businesses",
                'path' => "@inceRoot/businesses",
                'url' => "@cdnWeb/businesses"
            ],
            [
                'class' => CdnUploadImageBehavior::class,
                'attribute' => 'picture_desktop',
                'scenarios' => [self::SCENARIO_DEFAULT],
                'instanceByName' => false,
                //'placeholder' => "/assets/images/default.jpg",
                'deleteBasePathOnDelete' => false,
                'createThumbsOnSave' => false,
                'transferToCDN' => true,
                'cdnPath' => "@cdnRoot/businesses",
                'basePath' => "@inceRoot/businesses",
                'path' => "@inceRoot/businesses",
                'url' => "@cdnWeb/businesses"
            ],
            [
                'class' => CdnUploadImageBehavior::class,
                'attribute' => 'pic_main_desktop',
                'scenarios' => [self::SCENARIO_DEFAULT],
                'instanceByName' => false,
                //'placeholder' => "/assets/images/default.jpg",
                'deleteBasePathOnDelete' => false,
                'createThumbsOnSave' => false,
                'transferToCDN' => true,
                'cdnPath' => "@cdnRoot/businesses",
                'basePath' => "@inceRoot/businesses",
                'path' => "@inceRoot/businesses",
                'url' => "@cdnWeb/businesses"
            ],[
                'class' => CdnUploadImageBehavior::class,
                'attribute' => 'pic_main_mobile',
                'scenarios' => [self::SCENARIO_DEFAULT],
                'instanceByName' => false,
                //'placeholder' => "/assets/images/default.jpg",
                'deleteBasePathOnDelete' => false,
                'createThumbsOnSave' => false,
                'transferToCDN' => true,
                'cdnPath' => "@cdnRoot/businesses",
                'basePath' => "@inceRoot/businesses",
                'path' => "@inceRoot/businesses",
                'url' => "@cdnWeb/businesses"
            ],[
                'class' => CdnUploadImageBehavior::class,
                'attribute' => 'picture_mobile',
                'scenarios' => [self::SCENARIO_DEFAULT],
                'instanceByName' => false,
                //'placeholder' => "/assets/images/default.jpg",
                'deleteBasePathOnDelete' => false,
                'createThumbsOnSave' => false,
                'transferToCDN' => true,
                'cdnPath' => "@cdnRoot/businesses",
                'basePath' => "@inceRoot/businesses",
                'path' => "@inceRoot/businesses",
                'url' => "@cdnWeb/businesses"
            ],[
                'class' => CdnUploadImageBehavior::class,
                'attribute' => 'pic_small1_desktop',
                'scenarios' => [self::SCENARIO_DEFAULT],
                'instanceByName' => false,
                //'placeholder' => "/assets/images/default.jpg",
                'deleteBasePathOnDelete' => false,
                'createThumbsOnSave' => false,
                'transferToCDN' => true,
                'cdnPath' => "@cdnRoot/businesses",
                'basePath' => "@inceRoot/businesses",
                'path' => "@inceRoot/businesses",
                'url' => "@cdnWeb/businesses"
            ],[
                'class' => CdnUploadImageBehavior::class,
                'attribute' => 'pic_small1_mobile',
                'scenarios' => [self::SCENARIO_DEFAULT],
                'instanceByName' => false,
                //'placeholder' => "/assets/images/default.jpg",
                'deleteBasePathOnDelete' => false,
                'createThumbsOnSave' => false,
                'transferToCDN' => true,
                'cdnPath' => "@cdnRoot/businesses",
                'basePath' => "@inceRoot/businesses",
                'path' => "@inceRoot/businesses",
                'url' => "@cdnWeb/businesses"
            ],[
                'class' => CdnUploadImageBehavior::class,
                'attribute' => 'pic_small2_desktop',
                'scenarios' => [self::SCENARIO_DEFAULT],
                'instanceByName' => false,
                //'placeholder' => "/assets/images/default.jpg",
                'deleteBasePathOnDelete' => false,
                'createThumbsOnSave' => false,
                'transferToCDN' => true,
                'cdnPath' => "@cdnRoot/businesses",
                'basePath' => "@inceRoot/businesses",
                'path' => "@inceRoot/businesses",
                'url' => "@cdnWeb/businesses"
            ],[
                'class' => CdnUploadImageBehavior::class,
                'attribute' => 'pic_small2_mobile',
                'scenarios' => [self::SCENARIO_DEFAULT],
                'instanceByName' => false,
                //'placeholder' => "/assets/images/default.jpg",
                'deleteBasePathOnDelete' => false,
                'createThumbsOnSave' => false,
                'transferToCDN' => true,
                'cdnPath' => "@cdnRoot/businesses",
                'basePath' => "@inceRoot/businesses",
                'path' => "@inceRoot/businesses",
                'url' => "@cdnWeb/businesses"
            ],
        ];
    }
    public function getBusinessStory()
    {
        return $this->hasMany(BusinessesStory::class, ['businesses_id' => 'id'])->select(['id','year','title','texts','picture']);
    }
    public function getBusinessesInvestors()
    {
        return $this->hasMany(BusinessesInvestors::class, ['businesses_id' => 'id']);
    }

}
