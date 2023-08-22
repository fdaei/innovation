<?php

namespace common\models;

use common\behaviors\CdnUploadImageBehavior;
use Yii;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\TimestampBehavior;
use yii2tech\ar\softdelete\SoftDeleteBehavior;

/**
 * This is the model class for table "{{%hitech}}".
 *
 * @property int $id
 * @property string|null $title
 * @property string|null $description
 * @property string $required_skills
 * @property float|null $minimum_budget
 * @property float|null $maximum_budget
 * @property int $status
 * @property int|null $updated_by
 * @property int|null $updated_at
 * @property int|null $created_at
 * @property int|null $created_by
 * @property int $deleted_at
 *
 * @mixin TimestampBehavior
 * @mixin BlameableBehavior
 * @mixin SoftDeleteBehavior
 */
class Hitech extends \yii\db\ActiveRecord
{
    const STATUS_NOT_ACTIVE  = 0;
    const STATUS_ACTIVE     = 1;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%hitech}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['description'], 'string'],
            [['required_skills', 'status'], 'required'],
            [['required_skills'], 'safe'],
            [['minimum_budget', 'maximum_budget'], 'number'],
            [['status', 'updated_by', 'updated_at', 'created_at', 'created_by', 'deleted_at'], 'integer'],
            [['title'], 'string', 'max' => 255],
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
            'description' => Yii::t('app', 'Description'),
            'required_skills' => Yii::t('app', 'Required Skills'),
            'minimum_budget' => Yii::t('app', 'Minimum Budget'),
            'maximum_budget' => Yii::t('app', 'Maximum Budget'),
            'status' => Yii::t('app', 'Status'),
            'updated_by' => Yii::t('app', 'Updated By'),
            'updated_at' => Yii::t('app', 'Updated At'),
            'created_at' => Yii::t('app', 'Created At'),
            'created_by' => Yii::t('app', 'Created By'),
            'deleted_at' => Yii::t('app', 'Deleted At'),
        ];
    }
    public function getHitechCategories()
    {
        return $this->hasMany(FreelancerCategories::class, ['freelancer_id' => 'id'])->where(['model_class'=>Hitech::className()]);
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
        ];
    }
}
