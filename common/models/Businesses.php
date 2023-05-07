<?php

namespace common\models;

use common\behaviors\CdnUploadImageBehavior;
use Yii;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\TimestampBehavior;
use yii\helpers\HtmlPurifier;
use yii2tech\ar\softdelete\SoftDeleteBehavior;

/**
 * This is the model class for table "ince_businesses".
 *
 * @property int $id
 * @property string|null $picture_desktop
 * @property string|null $picture_mobile
 * @property string|null $site_name
 * @property string|null $name
 * @property string|null $business_logo
 * @property string|null $business_color
 * @property string|null $business_en_name
 * @property string|null $description_brief
 * @property string $wallpaper
 * @property string $mobile_wallpaper
 * @property string $tablet_wallpaper
 * @property string $short_description
 * @property string $investor_description
 * @property string $success_story
 * @property string $slug
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
 * @property string|null $services
 * @property int $status
 * @property int $updated_at
 * @property int $updated_by
 * @property int $created_by
 * @property int $created_at
 * @property int|null $deleted_at
 * @property BusinessesStory[] $businessesStory
 * @property BusinessStat[] $businessStates
 * @property BusinessGallery[] $businessGalleries
 * @property BusinessTimeline[] $businessTimelines
 * @property BusinessMember[] $businessMembers
 * @property BusinessMember[] $businessesInvestors
 *
 * @mixin CdnUploadImageBehavior
 */
class Businesses extends \yii\db\ActiveRecord
{
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
            [['services'], 'safe'],
            [['short_description', 'success_story', 'investor_description'], 'string', 'max' => 512],
            [['status'], 'required'],
            [['status', 'updated_at', 'updated_by', 'created_by', 'created_at', 'deleted_at'], 'integer'],
            ['wallpaper', 'image', 'minWidth' => 1920, 'maxWidth' => 1920, 'minHeight' => 348, 'maxHeight' => 348, 'extensions' => 'jpg, jpeg, png', 'maxSize' => 1024 * 1024 * 2, 'enableClientValidation' => false],
            ['mobile_wallpaper', 'image', 'minWidth' => 360, 'maxWidth' => 360, 'minHeight' => 348, 'maxHeight' => 348, 'extensions' => 'jpg, jpeg, png', 'maxSize' => 1024 * 1024 * 2, 'enableClientValidation' => false],
            ['tablet_wallpaper', 'image', 'minWidth' => 1023, 'maxWidth' => 1023, 'minHeight' => 990, 'maxHeight' => 990, 'extensions' => 'jpg, jpeg, png', 'maxSize' => 1024 * 1024 * 2, 'enableClientValidation' => false],
            [['picture_desktop','pic_main_mobile','pic_small1_desktop','pic_small1_mobile','pic_small2_desktop','pic_small2_mobile','picture_mobile','business_logo'], 'image','extensions' => 'jpg, jpeg, png','enableClientValidation' => false],
            [[ 'name','business_color', 'business_en_name', 'description_brief', 'website', 'telegram', 'instagram', 'whatsapp'], 'string', 'max' => 255],
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
            'services' => 'Services',
            'status' => 'Status',
            'updated_at' => 'Updated At',
            'updated_by' => 'Updated By',
            'created_by' => 'Created By',
            'created_at' => 'Created At',
            'deleted_at' => 'Deleted At',
            'slug' => Yii::t('app', 'Slug'),
            'wallpaper' => Yii::t('app', 'Wallpaper'),
            'mobile_wallpaper' => Yii::t('app', 'MobileWallpaper'),
            'tablet_wallpaper' => Yii::t('app', 'TabletWallpaper'),
            'short_description' => Yii::t('app', 'Short Description'),
            'investor_description' => Yii::t('app', 'Investor Description'),
            'success_story' => Yii::t('app', 'Success Story'),
        ];
    }

    public function getBusinessesStory()
    {
        return $this->hasMany(BusinessesStory::class, ['businesses_id' => 'id']);
    }

    public function getBusinessesInvestors()
    {
        return $this->hasMany(BusinessMember::class, ['business_id' => 'id']);
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

    public function getBusinessStates()
    {
        return $this->hasMany(BusinessStat::class, ['business_id' => 'id']);
    }

    public function getBusinessMembers()
    {
        return $this->hasMany(BusinessMember::class, ['business_id' => 'id']);
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

    public function getBusinessTimeLineItems()
    {
        return $this->hasMany(BusinessTimelineItem::class, ['business_timeline_id' => 'id'])
            ->viaTable('ince_business_timeline', ['business_id' => 'id']);
    }

    /**
     * Gets query for [[CreatedBy]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCreatedBy()
    {
        return $this->hasOne(User::class, ['id' => 'created_by']);
    }

    /**
     * Gets query for [[UpdatedBy]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUpdatedBy()
    {
        return $this->hasOne(User::class, ['id' => 'updated_by']);
    }

    /**
     * @return array
     */
    public function getMetaTags(): array
    {
        $metaTags=[];
        $metaTags[] = [
            "hid"=>"title",
            "name"=>"title",
            "content"=>$this->name
        ];
        $metaTags[] = [
            "hid"=>"short_description",
            "name"=>"short_description",
            "content"=>$this->short_description
        ];
        $metaTags[] = [
            "hid"=>"investor_description",
            "name"=>"investor_description",
            "content"=>$this->investor_description
        ];
        $metaTags[] = [
            "hid"=>"success_story",
            "name"=>"success_story",
            "content"=>$this->success_story
        ];
        $metaTags[] = [
            "hid"=>"success_story",
            "name"=>"success_story",
            "content"=>$this->success_story
        ];
        return $metaTags;
    }

    public function beforeSave($insert)
    {
        $this->short_description = HtmlPurifier::process($this->short_description);
        $this->success_story = HtmlPurifier::process($this->success_story);
        $this->investor_description = HtmlPurifier::process($this->investor_description);

        return parent::beforeSave($insert);
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
                'cdnPath' => "@cdnRoot/business",
                'basePath' => "@inceRoot/business",
                'path' => "@inceRoot/business",
                'url' => "@cdnWeb/business"
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
                'cdnPath' => "@cdnRoot/business",
                'basePath' => "@inceRoot/business",
                'path' => "@inceRoot/business",
                'url' => "@cdnWeb/business"
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
                'cdnPath' => "@cdnRoot/business",
                'basePath' => "@inceRoot/business",
                'path' => "@inceRoot/business",
                'url' => "@cdnWeb/business"
            ],[
                'class' => CdnUploadImageBehavior::class,
                'attribute' => 'pic_main_desktop',
                'scenarios' => [self::SCENARIO_DEFAULT],
                'instanceByName' => false,
                //'placeholder' => "/assets/images/default.jpg",
                'deleteBasePathOnDelete' => false,
                'createThumbsOnSave' => false,
                'transferToCDN' => true,
                'cdnPath' => "@cdnRoot/business",
                'basePath' => "@inceRoot/business",
                'path' => "@inceRoot/business",
                'url' => "@cdnWeb/business"
            ],[
                'class' => CdnUploadImageBehavior::class,
                'attribute' => 'pic_main_mobile',
                'scenarios' => [self::SCENARIO_DEFAULT],
                'instanceByName' => false,
                //'placeholder' => "/assets/images/default.jpg",
                'deleteBasePathOnDelete' => false,
                'createThumbsOnSave' => false,
                'transferToCDN' => true,
                'cdnPath' => "@cdnRoot/business",
                'basePath' => "@inceRoot/business",
                'path' => "@inceRoot/business",
                'url' => "@cdnWeb/business"
            ],[
                'class' => CdnUploadImageBehavior::class,
                'attribute' => 'picture_mobile',
                'scenarios' => [self::SCENARIO_DEFAULT],
                'instanceByName' => false,
                //'placeholder' => "/assets/images/default.jpg",
                'deleteBasePathOnDelete' => false,
                'createThumbsOnSave' => false,
                'transferToCDN' => true,
                'cdnPath' => "@cdnRoot/business",
                'basePath' => "@inceRoot/business",
                'path' => "@inceRoot/business",
                'url' => "@cdnWeb/business"
            ],[
                'class' => CdnUploadImageBehavior::class,
                'attribute' => 'pic_small1_desktop',
                'scenarios' => [self::SCENARIO_DEFAULT],
                'instanceByName' => false,
                //'placeholder' => "/assets/images/default.jpg",
                'deleteBasePathOnDelete' => false,
                'createThumbsOnSave' => false,
                'transferToCDN' => true,
                'cdnPath' => "@cdnRoot/business",
                'basePath' => "@inceRoot/business",
                'path' => "@inceRoot/business",
                'url' => "@cdnWeb/business"
            ],[
                'class' => CdnUploadImageBehavior::class,
                'attribute' => 'pic_small1_mobile',
                'scenarios' => [self::SCENARIO_DEFAULT],
                'instanceByName' => false,
                //'placeholder' => "/assets/images/default.jpg",
                'deleteBasePathOnDelete' => false,
                'createThumbsOnSave' => false,
                'transferToCDN' => true,
                'cdnPath' => "@cdnRoot/business",
                'basePath' => "@inceRoot/business",
                'path' => "@inceRoot/business",
                'url' => "@cdnWeb/business"
            ],[
                'class' => CdnUploadImageBehavior::class,
                'attribute' => 'pic_small2_desktop',
                'scenarios' => [self::SCENARIO_DEFAULT],
                'instanceByName' => false,
                //'placeholder' => "/assets/images/default.jpg",
                'deleteBasePathOnDelete' => false,
                'createThumbsOnSave' => false,
                'transferToCDN' => true,
                'cdnPath' => "@cdnRoot/business",
                'basePath' => "@inceRoot/business",
                'path' => "@inceRoot/business",
                'url' => "@cdnWeb/business"
            ],[
                'class' => CdnUploadImageBehavior::class,
                'attribute' => 'pic_small2_mobile',
                'scenarios' => [self::SCENARIO_DEFAULT],
                'instanceByName' => false,
                //'placeholder' => "/assets/images/default.jpg",
                'deleteBasePathOnDelete' => false,
                'createThumbsOnSave' => false,
                'transferToCDN' => true,
                'cdnPath' => "@cdnRoot/business",
                'basePath' => "@inceRoot/business",
                'path' => "@inceRoot/business",
                'url' => "@cdnWeb/business"
            ],
            [
                'class' => CdnUploadImageBehavior::class,
                'attribute' => 'wallpaper',
                'scenarios' => [self::SCENARIO_DEFAULT],
                'instanceByName' => false,
                //'placeholder' => "/assets/images/default.jpg",
                'deleteBasePathOnDelete' => false,
                'createThumbsOnSave' => false,
                'transferToCDN' => false,
                'cdnPath' => "@cdnRoot/business",
                'basePath' => "@inceRoot/business",
                'path' => "@inceRoot/business",
                'url' => "@cdnWeb/business"
            ],
            [
                'class' => CdnUploadImageBehavior::class,
                'attribute' => 'mobile_wallpaper',
                'scenarios' => [self::SCENARIO_DEFAULT],
                'instanceByName' => false,
                //'placeholder' => "/assets/images/default.jpg",
                'deleteBasePathOnDelete' => false,
                'createThumbsOnSave' => false,
                'transferToCDN' => false,
                'cdnPath' => "@cdnRoot/business",
                'basePath' => "@inceRoot/business",
                'path' => "@inceRoot/business",
                'url' => "@cdnWeb/business"
            ],
            [
                'class' => CdnUploadImageBehavior::class,
                'attribute' => 'tablet_wallpaper',
                'scenarios' => [self::SCENARIO_DEFAULT],
                'instanceByName' => false,
                'deleteBasePathOnDelete' => false,
                'createThumbsOnSave' => false,
                'transferToCDN' => false,
                'cdnPath' => "@cdnRoot/business",
                'basePath' => "@inceRoot/business",
                'path' => "@inceRoot/business",
                'url' => "@cdnWeb/business"
            ],
        ];
    }

    public function canDelete()
    {
        return true;
    }

    public function extraFields()
    {
        return [
            'timeLines' => 'businessTimelines',
            'galleries' => 'businessGalleries',
            'stats' => 'businessStates',
            'stories' => 'businessesStory',
            'members' => 'businessMembers',
            'metaTags',
        ];
    }
}