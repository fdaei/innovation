<?php

namespace common\models;

use common\behaviors\CdnUploadImageBehavior;
use Yii;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\TimestampBehavior;
use yii\helpers\HtmlPurifier;
use yii2tech\ar\softdelete\SoftDeleteBehavior;

/**
 * This is the model class for table "business_stat".
 *
 * @property int $id
 * @property int $business_id
 * @property string $type
 * @property string $title
 * @property string $subtitle
 * @property string $icon
 * @property int $status
 * @property int $created_at
 * @property int $created_by
 * @property int $updated_at
 * @property int $updated_by
 * @property int $deleted_at
 *  *
 * @property Business $business
 * @property User $createdBy
 * @property User $updatedBy
 */
class BusinessStat extends \yii\db\ActiveRecord
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
        return '{{%business_stat}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['business_id', 'type', 'title', 'subtitle', 'status'], 'required', 'on' => [self::SCENARIO_CREATE]],
            [['business_id', 'type', 'title', 'subtitle', 'status'], 'required', 'on' => [self::SCENARIO_UPDATE]],
            [['business_id', 'status'], 'integer'],
            [['type', 'title', 'subtitle'], 'string', 'max' => 255],
            ['icon', 'image', 'minWidth' => 96, 'maxWidth' => 96, 'minHeight' => 96, 'maxHeight' => 96, 'extensions' => 'jpg, jpeg, png', 'maxSize' => 1024 * 1024 * 2, 'enableClientValidation' => false],
        ];
    }

    public function scenarios()
    {
        $scenarios = parent::scenarios();
        $scenarios[self::SCENARIO_CREATE] = ['business_id', 'type', 'title', 'subtitle', '!status'];
        $scenarios[self::SCENARIO_UPDATE] = ['business_id', 'type', 'title', 'subtitle', '!status', 'icon'];

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
            'type' => Yii::t('app', 'Type'),
            'title' => Yii::t('app', 'Title'),
            'subtitle' => Yii::t('app', 'Subtitle'),
            'icon' => Yii::t('app', 'Icon'),
            'status' => Yii::t('app', 'Status'),
            'created_at' => Yii::t('app', 'Created At'),
            'created_by' => Yii::t('app', 'Created By'),
            'updated_at' => Yii::t('app', 'Updated At'),
            'update_by' => Yii::t('app', 'Update By'),
            'deleted_at' => Yii::t('app', 'Deleted At'),
        ];
    }

    /**
     * {@inheritdoc}
     * @return BusinessStatQuery the active query used by this AR class.
     */
    public function getBusiness()
    {
        return $this->hasOne(Business::class, ['id' => 'business_id']);
    }


    public function beforeSave($insert)
    {
        $this->subtitle = HtmlPurifier::process($this->subtitle);

        return parent::beforeSave($insert);
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

    public static function find(): BusinessStatQuery
    {
        $query = new BusinessStatQuery(get_called_class());
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
                'attribute' => 'icon',
                'scenarios' => [self::SCENARIO_DEFAULT],
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
            'type',
            'title',
            'subtitle',
            'icon' => function (self $model) {
                return $model->getUploadUrl('icon');
            },
        ];
    }

    public function extraFields()
    {
        return parent::extraFields(); // TODO: Change the autogenerated stub
    }
}