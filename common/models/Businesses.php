<?php

namespace common\models;

use common\behaviors\CdnUploadImageBehavior;
use Yii;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\TimestampBehavior;
use yii2tech\ar\softdelete\SoftDeleteBehavior;

/**
 * This is the model class for table "ince_businesses".
 *
 * @property int $id
 * @property string|null $picture_desktop
 * @property string|null $picture_mobile
 * @property string|null site_name
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
    public $site_name;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'ince_businesses';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['description','site_name'], 'string'],
            [['statistics', 'services', 'investors'], 'safe'],
            [['status'], 'required'],
            [['status', 'updated_at', 'updated_by', 'created_by', 'created_at', 'deleted_at'], 'integer'],
            [['picture_desktop','pic_main_mobile','pic_small1_desktop','pic_small1_mobile','pic_small2_desktop','pic_small2_mobile'], 'image','extensions' => 'jpg, jpeg, png','enableClientValidation' => false],
            [[  'name','business_color', 'business_en_name', 'description_brief', 'website', 'telegram', 'instagram', 'whatsapp'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'picture_desktop' => 'Picture Desktop',
            'picture_mobile' => 'Picture Mobile',
            'name' => 'Name',
            'business_logo' => 'Business Logo',
            'business_color' => 'Business Color',
            'business_en_name' => 'Business En Name',
            'description_brief' => 'Description Brief',
            'description' => 'Description',
            'website' => 'Website',
            'telegram' => 'Telegram',
            'instagram' => 'Instagram',
            'whatsapp' => 'Whatsapp',
            'pic_main_desktop' => 'Pic Main Desktop',
            'pic_main_mobile' => 'Pic Main Mobile',
            'pic_small1_desktop' => 'Pic Small1 Desktop',
            'pic_small1_mobile' => 'Pic Small1 Mobile',
            'pic_small2_desktop' => 'Pic Small2 Desktop',
            'pic_small2_mobile' => 'Pic Small2 Mobile',
            'statistics' => 'Statistics',
            'services' => 'Services',
            'investors' => 'Investors',
            'status' => 'Status',
            'updated_at' => 'Updated At',
            'updated_by' => 'Updated By',
            'created_by' => 'Created By',
            'created_at' => 'Created At',
            'deleted_at' => 'Deleted At',
        ];
    }
    public function getBusinessesStory()
    {
        return $this->hasMany(BusinessesStory::class, ['businesses_id' => 'id']);
    }
    public function getBusinessesInvestors()
    {
        return $this->hasMany(BusinessesInvestors::class, ['businesses_id' => 'id']);
    }

    public static function find()
    {
        $query = new BusinessesQuery(get_called_class());
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

    public function canDelete()
    {
        return true;
    }

}
