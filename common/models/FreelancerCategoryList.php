<?php

namespace common\models;

use common\behaviors\CdnUploadImageBehavior;
use Yii;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii2tech\ar\softdelete\SoftDeleteBehavior;

/**
 * This is the model class for table "{{%freelancer_category_list}}".
 *
 * @property int $id
 * @property string $title
 * @property string|null $brief_description
 * @property string|null $picture
 * @property int $status
 * @property int $updated_by
 * @property int|null $updated_at
 * @property int $created_at
 * @property int $deleted_at
 * @property int $created_by
 *
 * @property User $createdBy
 * @property FreelancerCategories[] $freelancerCategories
 * @property User $updatedBy
 */
class FreelancerCategoryList extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%freelancer_category_list}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title'], 'required'],
            [['status', 'updated_by', 'updated_at', 'created_at', 'deleted_at', 'created_by'], 'integer'],
            [['title', 'brief_description'], 'string', 'max' => 255],
            ['picture', 'image','extensions' => 'jpg, jpeg, png', 'enableClientValidation' => false],
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
            'brief_description' => Yii::t('app', 'Brief Description'),
            'picture' => Yii::t('app', 'Picture'),
            'status' => Yii::t('app', 'Status'),
            'updated_by' => Yii::t('app', 'Updated By'),
            'updated_at' => Yii::t('app', 'Updated At'),
            'created_at' => Yii::t('app', 'Created At'),
            'deleted_at' => Yii::t('app', 'Deleted At'),
            'created_by' => Yii::t('app', 'Created By'),
        ];
    }

    /**
     * Gets query for [[CreatedBy]].
     *
     * @return \yii\db\ActiveQuery|yii\db\ActiveQuery
     */
    public function getCreatedBy()
    {
        return $this->hasOne(User::class, ['id' => 'created_by'])->inverseOf('freelancerCategoryLists');
    }

    /**
     * Gets query for [[UpdatedBy]].
     *
     * @return \yii\db\ActiveQuery|yii\db\ActiveQuery
     */
    public function getUpdatedBy()
    {
        return $this->hasOne(User::class, ['id' => 'updated_by'])->inverseOf('freelancerCategoryLists0');
    }

    /**
     * {@inheritdoc}
     * @return FreelancerCategoryListQuery the active query used by this AR class.
     */
    public static function find()
    {
        $query = new FreelancerCategoryListQuery(get_called_class());
        return $query->notDeleted();

    }

    /**
     * Gets query for [[FreelancerCategories]].
     *
     * @return \yii\db\ActiveQuery|FreelancerCategoriesQuery
     */
    public function getFreelancerCategories()
    {
        return $this->hasMany(FreelancerCategories::class, ['categories_id' => 'id'])->inverseOf('categories');
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
                'attribute' => 'picture',
                'scenarios' => [self::SCENARIO_DEFAULT],
                'instanceByName' => false,
                'deleteBasePathOnDelete' => false,
                'createThumbsOnSave' => false,
                'transferToCDN' => true,
                'cdnPath' => "@cdnRoot/freelancerCategoryList",
                'basePath' => "@inceRoot/freelancerCategoryList",
                'path' => "@inceRoot/freelancerCategoryList",
                'url' => "@cdnWeb/freelancerCategoryList"
            ],

        ];
    }
}
