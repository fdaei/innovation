<?php

namespace common\models;

use Yii;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveQuery;
use yii\db\ActiveRecord;
use yii2tech\ar\softdelete\SoftDeleteBehavior;

/**
 * This is the model class for table "{{%mentor_categories}}".
 *
 * @property int $id
 * @property int $mentor_id
 * @property int $category_id
 * @property int $created_at
 * @property int|null $updated_at
 * @property int $created_by
 * @property int $updated_by
 * @property int $status
 * @property int $deleted_at
 *
 * @property MentorCategory $category
 * @property User $createdBy
 * @property Mentor $mentor
 * @property User $updatedBy
 */
class MentorCategories extends ActiveRecord
{
    const STATUS_ACTIVE = 1;
    const STATUS_DELETED = 2;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%mentor_categories}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['mentor_id', 'category_id'], 'required'],
            [['mentor_id', 'category_id', 'created_at', 'updated_at', 'created_by', 'updated_by', 'status', 'deleted_at'], 'integer'],
            [['category_id'], 'exist', 'skipOnError' => true, 'targetClass' => MentorCategory::class, 'targetAttribute' => ['category_id' => 'id']],
            [['updated_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['updated_by' => 'id']],
            [['created_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['created_by' => 'id']],
            [['mentor_id'], 'exist', 'skipOnError' => true, 'targetClass' => Mentor::class, 'targetAttribute' => ['mentor_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'mentor_id' => Yii::t('app', 'Mentor ID'),
            'category_id' => Yii::t('app', 'Category ID'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
            'created_by' => Yii::t('app', 'Created By'),
            'updated_by' => Yii::t('app', 'Updated By'),
            'status' => Yii::t('app', 'Status'),
            'deleted_at' => Yii::t('app', 'Deleted At'),
        ];
    }

    /**
     * Gets query for [[Category]].
     *
     * @return ActiveQuery|MentorCategoryQuery
     */
    public function getCategory()
    {
        return $this->hasOne(MentorCategory::class, ['id' => 'category_id'])->inverseOf('mentorCategories');
    }

    /**
     * Gets query for [[CreatedBy]].
     *
     * @return ActiveQuery|ActiveQuery
     */
    public function getCreatedBy()
    {
        return $this->hasOne(User::class, ['id' => 'created_by'])->inverseOf('mentorCategories0');
    }

    /**
     * Gets query for [[Mentor]].
     *
     * @return ActiveQuery|MentorQuery
     */
    public function getMentor()
    {
        return $this->hasOne(Mentor::class, ['id' => 'mentor_id'])->inverseOf('mentorCategories');
    }

    /**
     * Gets query for [[UpdatedBy]].
     *
     * @return ActiveQuery|ActiveQuery
     */
    public function getUpdatedBy()
    {
        return $this->hasOne(User::class, ['id' => 'updated_by'])->inverseOf('mentorCategories');
    }

    /**
     * {@inheritdoc}
     * @return MentorCategoriesQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new MentorCategoriesQuery(get_called_class());
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
                    'status' => self::STATUS_DELETED,
                ],
                'restoreAttributeValues' => [
                    'deleted_at' => 0,
                    'status' => [self::STATUS_ACTIVE]
                ],
                'replaceRegularDelete' => false, // mutate native `delete()` method
                'invokeDeleteEvents' => false
            ],
        ];
    }
}
