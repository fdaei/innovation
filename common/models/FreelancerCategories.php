<?php

namespace common\models;

use Yii;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveQuery;
use yii\db\ActiveRecord;
use yii2tech\ar\softdelete\SoftDeleteBehavior;

/**
 * This is the model class for table "{{%freelancer_categories}}".
 *
 * @property int $id
 * @property int $freelancer_id
 * @property int $categories_id
 * @property string|null $model_class
 * @property int $created_at
 * @property int|null $updated_at
 * @property int $created_by
 * @property int $updated_by
 * @property int $status
 *
 * @property User $createdBy
 * @property User $updatedBy
 */
class FreelancerCategories extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%freelancer_categories}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['freelancer_id', 'categories_id'], 'required'],
            [['freelancer_id', 'categories_id', 'created_at', 'updated_at', 'created_by', 'updated_by', 'status'], 'integer'],
            [['model_class'], 'string', 'max' => 255],
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
            'freelancer_id' => Yii::t('app', 'Freelancer ID'),
            'categories_id' => Yii::t('app', 'Categories ID'),
            'model_class' => Yii::t('app', 'Model Class'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
            'created_by' => Yii::t('app', 'Created By'),
            'updated_by' => Yii::t('app', 'Updated By'),
            'status' => Yii::t('app', 'Status'),
        ];
    }

    /**
     * Gets query for [[CreatedBy]].
     *
     * @return ActiveQuery|ActiveQuery
     */
    public function getCreatedBy()
    {
        return $this->hasOne(User::class, ['id' => 'created_by'])->inverseOf('freelancerCategories');
    }

    /**
     * Gets query for [[UpdatedBy]].
     *
     * @return ActiveQuery|ActiveQuery
     */
    public function getUpdatedBy()
    {
        return $this->hasOne(User::class, ['id' => 'updated_by'])->inverseOf('freelancerCategories0');
    }

    /**
     * {@inheritdoc}
     * @return FreelancerCategoriesQuery the active query used by this AR class.
     */
    public static function find()
    {
        $query = new FreelancerCategoriesQuery(get_called_class());
        return $query->notDeleted();
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
