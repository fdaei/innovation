<?php

namespace common\models;

use common\behaviors\CdnUploadImageBehavior;
use Yii;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\TimestampBehavior;
use yii2tech\ar\softdelete\SoftDeleteBehavior;

/**
 * This is the model class for table "{{%branches}}".
 *
 * @property int $id
 * @property string $title
 * @property string $address
 * @property float $longitude
 * @property float $latitude
 * @property string $mobile
 * @property string $phone
 * @property int $desk_count
 * @property int $status
 * @property int $updated_at
 * @property int $updated_by
 * @property int $created_by
 * @property int $created_at
 * @property int $deleted_at
 * @property int $description
 * @property int $image
 *
 * @property BranchesAdmin[] $branchesAdmins
 * @property BranchesSpecification[] $branchesSpecifications
 *
 * @mixin TimestampBehavior
 * @mixin BlameableBehavior
 * @mixin SoftDeleteBehavior
 */
class Branches extends \yii\db\ActiveRecord
{
    const SCENARIO_UPDATE = 'update';
    const SCENARIO_CREATE = 'create';

    public static function tableName()
    {
        return '{{%branches}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title', 'address', 'longitude', 'latitude', 'mobile', 'phone', 'desk_count', 'status','image','description'], 'required', 'on' => [self::SCENARIO_CREATE]],
            [['title', 'address', 'longitude', 'latitude', 'mobile', 'phone', 'desk_count', 'status','description'], 'required', 'on' => [self::SCENARIO_UPDATE]],
            [['address'], 'string'],
            [['description'], 'string'],
            [['mobile'], 'match', 'pattern' => '/^([0]{1}[9]{1}[0-9]{9})$/'],
            ['image','image','extensions' => 'jpg, jpeg, png','enableClientValidation' => false],
            [['longitude', 'latitude'], 'number'],
            [['desk_count', 'status', 'updated_at', 'updated_by', 'created_by', 'created_at', 'deleted_at'], 'integer'],
            [['title'], 'string', 'max' => 255],
            [['mobile'], 'string', 'max' => 11],
            [['phone'], 'string', 'max' => 11],
        ];
    }

    public function scenarios()
    {
        $scenarios = parent::scenarios();

        $scenarios[self::SCENARIO_CREATE] = ['title', 'address', 'longitude','latitude','image','mobile','phone','desk_count','status','description'];
        $scenarios[self::SCENARIO_UPDATE] = ['title', 'address', 'longitude','latitude','mobile','phone','desk_count','status'];

        return $scenarios;
    }
    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'title' => Yii::t('app', 'Title'),
            'address' => Yii::t('app', 'Address'),
            'longitude' => Yii::t('app', 'Longitude'),
            'latitude' => Yii::t('app', 'Latitude'),
            'mobile' => Yii::t('app', 'Mobile'),
            'phone' => Yii::t('app', 'Phone'),
            'desk_count' => Yii::t('app', 'Desk Count'),
            'status' => Yii::t('app', 'Status'),
            'image' => Yii::t('app', 'Image'),
            'updated_at' => Yii::t('app', 'Updated At'),
            'updated_by' => Yii::t('app', 'Updated By'),
            'created_by' => Yii::t('app', 'Created By'),
            'created_at' => Yii::t('app', 'Created At'),
            'deleted_at' => Yii::t('app', 'Deleted At'),
            'description'=> Yii::t('app','Description')
        ];
    }

    /**
     * Gets query for [[BranchesAdmins]].
     *
     * @return \yii\db\ActiveQuery|BranchesAdminQuery
     */
    public function getBranchesAdmins()
    {
        return $this->hasMany(BranchesAdmin::class, ['branche_id' => 'id']);
    }

    /**
     * Gets query for [[BranchesSpecifications]].
     *
     * @return \yii\db\ActiveQuery|BranchesSpecificationQuery
     */
    public function getBranchesSpecifications()
    {
        return $this->hasMany(BranchesSpecification::class, ['branche_id' => 'id']);
    }
    public function getBranchesGallery()
    {
        return $this->hasMany(BranchesGallery::class, ['branche_id' => 'id']);
    }
    /**
     * {@inheritdoc}
     * @return BranchesQuery the active query used by this AR class.
     */
    public static function find()
    {
        $query = new BranchesQuery(get_called_class());
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
                'attribute' => 'image',
                'scenarios' => [self::SCENARIO_CREATE,self::SCENARIO_UPDATE],
                'instanceByName' => false,
                //'placeholder' => "/assets/images/default.jpg",
                'deleteBasePathOnDelete' => false,
                'createThumbsOnSave' => false,
                'transferToCDN' => true,
                'cdnPath' => "@cdnRoot/Branches",
                'basePath' => "@inceRoot/Branches",
                'path' => "@inceRoot/Branches",
                'url' => "@cdnWeb/Branches"
            ],
        ];
    }

    public function fields()
    {
        return [
            'id',
            'title',
            'address',
            'longitude',
            'latitude',
            'mobile',
            'phone',
            'desk_count',
            'status',
        ];
    }

    public function extraFields()
    {
        return [];
    }
}
