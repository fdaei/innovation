<?php

namespace common\models;

use common\behaviors\CdnUploadImageBehavior;
use Yii;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\TimestampBehavior;
use yii2tech\ar\softdelete\SoftDeleteBehavior;

/**
 * This is the model class for table "{{%branches_gallery}}".
 *
 * @property int $id
 * @property int $branche_id
 * @property string $image
 * @property string $mobile_image
 * @property string $tablet_image
 * @property int $status
 * @property int $created_at
 * @property int $created_by
 * @property int $updated_at
 * @property int $updated_by
 * @property int $deleted_at
 *
 * @property Branches $branche
 * @property User $createdBy
 * @property User $updatedBy
 */
class BranchesGallery extends \yii\db\ActiveRecord
{
    const SCENARIO_UPDATE = 'update';
    const SCENARIO_CREATE = 'create';
    public static function tableName()
    {
        return '{{%branches_gallery}}';
    }
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['status','image','mobile_image','tablet_image'], 'required', 'on' => [self::SCENARIO_CREATE]],
            [['status'], 'required', 'on' => [self::SCENARIO_UPDATE]],
            ['image', 'image','extensions' => 'jpg, jpeg, png','enableClientValidation' => false],
            ['mobile_image', 'image','extensions' => 'jpg, jpeg, png', 'enableClientValidation' => false],
            ['tablet_image', 'image','extensions' => 'jpg, jpeg, png', 'enableClientValidation' => false],
            [['branche_id'], 'exist', 'skipOnError' => true, 'targetClass' => Branches::class, 'targetAttribute' => ['branche_id' => 'id']],
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
            'branche_id' => Yii::t('app', 'Branche ID'),
            'image' => Yii::t('app', 'Image'),
            'mobile_image' => Yii::t('app', 'Mobile Image'),
            'tablet_image' => Yii::t('app', 'Tablet Image'),
            'status' => Yii::t('app', 'Status'),
            'created_at' => Yii::t('app', 'Created At'),
            'created_by' => Yii::t('app', 'Created By'),
            'updated_at' => Yii::t('app', 'Updated At'),
            'updated_by' => Yii::t('app', 'Updated By'),
            'deleted_at' => Yii::t('app', 'Deleted At'),
        ];
    }
    public function scenarios()
    {
        $scenarios = parent::scenarios();

        $scenarios[self::SCENARIO_CREATE] = ['status','image','mobile_image','tablet_image'];
        $scenarios[self::SCENARIO_UPDATE] = ['status'];

        return $scenarios;
    }
    /**
     * Gets query for [[Branche]].
     *
     * @return \yii\db\ActiveQuery|BranchesQuery
     */
    public function getBranche()
    {
        return $this->hasOne(Branches::class, ['id' => 'branche_id']);
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

    /**
     * Gets query for [[UpdatedBy]].
     *
     * @return \yii\db\ActiveQuery|yii\db\ActiveQuery
     */
    public function getUpdatedBy()
    {
        return $this->hasOne(User::class, ['id' => 'updated_by']);
    }

    /**
     * {@inheritdoc}
     * @return BranchesGalleryQuery the active query used by this AR class.
     */
    public static function find()
    {
        $query = new BranchesGalleryQuery(get_called_class());
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
            [
                'class' => CdnUploadImageBehavior::class,
                'attribute' => 'tablet_image',
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
            'id',
            'branche_id',
            'image',
            'mobile_image',
            'tablet_image',
            'status',
            'created_at',
            'created_by',
            'updated_at',
            'updated_by',
            'deleted_at',
        ];
    }

    public function extraFields()
    {
        return [];
    }
}
