<?php

namespace common\models;

use common\behaviors\CdnUploadImageBehavior;
use Yii;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\TimestampBehavior;
use yii\helpers\HtmlPurifier;
use yii2tech\ar\softdelete\SoftDeleteBehavior;

/**
 * This is the model class for table "ince_job_position".
 *
 * @property int $id
 * @property string $title
 * @property int $org_unit_id
 * @property string $description
 * @property string $requirements
 * @property int $status
 * @property int $created_at
 * @property int $created_by
 * @property int $updated_at
 * @property int $updated_by
 * @property int $immediate
 *
 * @property CareerApply[] $careerApplies
 * @property User $createdBy
 * @property OrgUnit $orgUnit
 * @property User $updatedBy
 * @mixin SoftDeleteBehavior
 */
class JobPosition extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    const STATUS_ACTIVE = 1;
    const STATUS_DELETED = 0;
    const STATUS_INACTIVE = 2;


    public static function tableName()
    {
        return 'ince_job_position';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title', 'org_unit_id', 'description', 'requirements'], 'required'],
            [['org_unit_id', 'status','immediate'], 'integer'],
            [['title'], 'string', 'max' => 128],
            [['description', 'requirements'], 'string', 'max' => 1024],
            [['org_unit_id'], 'exist', 'skipOnError' => true, 'targetClass' => OrgUnit::class, 'targetAttribute' => ['org_unit_id' => 'id']],
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
            'org_unit_id' => Yii::t('app', 'Org Unit ID'),
            'description' => Yii::t('app', 'Description'),
            'immediate' => Yii::t('app', 'Immediate'),
            'requirements' => Yii::t('app', 'Requirements'),
            'status' => Yii::t('app', 'Status'),
            'created_at' => Yii::t('app', 'Created At'),
            'created_by' => Yii::t('app', 'Created By'),
            'updated_at' => Yii::t('app', 'Updated At'),
            'updated_by' => Yii::t('app', 'Updated By'),
        ];
    }

    /**
     * Gets query for [[CareerApplies]].
     *
     * @return \yii\db\ActiveQuery|CareerApplyQuery
     */
    public function getCareerApplies()
    {
        return $this->hasMany(CareerApply::class, ['job_position_id' => 'id']);
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
     * Gets query for [[OrgUnit]].
     *
     * @return \yii\db\ActiveQuery|CareerApplyQuery
     */
    public function getOrgUnit()
    {
        return $this->hasOne(OrgUnit::class, ['id' => 'org_unit_id']);
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
     * @return JobPositionQuery the active query used by this AR class.
     */
    public static function find()
    {
        $query = new JobPositionQuery(get_called_class());
        return $query->active();
    }

    public function canDelete()
    {
        $job = CareerApply::find()->active()->andWhere(['job_position_id' => $this->id])->limit(1)->one();
        if ($job) {
            $this->addError('business_id', Yii::t('app', 'jobPosition has an active CareerApply'));
            return false;
        }
        return true;
    }

    public function beforeSave($insert)
    {
        $this->description = HtmlPurifier::process($this->description);
        $this->requirements = HtmlPurifier::process($this->requirements);
        return parent::beforeSave($insert);
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
        ];
    }

    public function fields()
    {
        return [
            'id',
            'title',
            'description',
            'requirements',
            'immediate',
        ];
    }

    public function extraFields()
    {
        return [
            'orgUnit'
        ];
    }
}