<?php

namespace common\models;

use common\behaviors\CdnUploadImageBehavior;
use Yii;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveQuery;
use yii\db\ActiveRecord;
use yii\helpers\ArrayHelper;
use yii2tech\ar\softdelete\SoftDeleteBehavior;

/**
 * This is the model class for table "{{%freelancer_portfolio}}".
 *
 * @property int $id
 * @property int $freelancer_id
 * @property string $title
 * @property string|null $link
 * @property string|null $description
 * @property string|null $image
 * @property int $status
 * @property int|null $updated_by
 * @property int $updated_at
 * @property int $created_at
 * @property int $created_by
 * @property int $deleted_at
 *
 * @property Freelancer $freelancer
 */
class FreelancerPortfolio extends ActiveRecord
{

    const STATUS_ACTIVE = 1;
    const STATUS_DELETED = 2;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%freelancer_portfolio}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['freelancer_id', 'title'], 'required'],
            [['freelancer_id', 'status', 'updated_by', 'updated_at', 'created_at', 'created_by', 'deleted_at'], 'integer'],
            [['title', 'link'], 'string', 'max' => 32],
            [['description'], 'string', 'max' => 512],
            ['image', 'image','extensions' => 'jpg, jpeg, png', 'enableClientValidation' => false],
            ['link', 'url'],
            [['freelancer_id'], 'exist', 'skipOnError' => true, 'targetClass' => Freelancer::class, 'targetAttribute' => ['freelancer_id' => 'id']],
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
            'freelancer_id' => Yii::t('app', 'Freelancer'),
            'title' => Yii::t('app', 'Title'),
            'link' => Yii::t('app', 'Link'),
            'description' => Yii::t('app', 'Description'),
            'image' => Yii::t('app', 'Image'),
            'status' => Yii::t('app', 'Status'),
            'updated_by' => Yii::t('app', 'Updated By'),
            'updated_at' => Yii::t('app', 'Updated At'),
            'created_at' => Yii::t('app', 'Created At'),
            'created_by' => Yii::t('app', 'Created By'),
            'deleted_at' => Yii::t('app', 'Deleted At'),
        ];
    }

    /**
     * Gets query for [[Freelancer]].
     *
     * @return ActiveQuery|FreelancerQuery
     */
    public function getFreelancer()
    {
        return $this->hasOne(Freelancer::class, ['id' => 'freelancer_id'])->inverseOf('freelancerPortfolios');
    }

    /**
     * @return FreelancerPortfolioQuery the active query used by this AR class.
     */
    public static function find()
    {
        $query = new FreelancerPortfolioQuery(get_called_class());
        return $query->notDeleted();
    }

    public static function Handler($items = [])
    {
        $portfolios = Model::createMultiple(FreelancerPortfolio::class, $items);
        $model = Model::loadMultiple($portfolios, Yii::$app->request->post());
        if ($items) {
            $oldIDs = ArrayHelper::map($items, 'id', 'id');
            $deletedIDs = array_diff($oldIDs, array_filter(ArrayHelper::map($portfolios, 'id', 'id')));
        }
        if (!empty($deletedIDs)) {
            FreelancerPortfolio::deleteAll(['id' => $deletedIDs]);
        }

        return $portfolios;
    }

    public static function itemAlias($type, $code = NULL)
    {
        $_items = [
            'Status' => [
                self::STATUS_ACTIVE => Yii::t('app', 'ACTIVE'),
                self::STATUS_DELETED => Yii::t('app', 'INACTIVE'),
            ],
        ];

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
                    'status' => self::STATUS_DELETED,
                ],
                'restoreAttributeValues' => [
                    'deleted_at' => 0,
                    'status' => [self::STATUS_ACTIVE]
                ],
                'replaceRegularDelete' => false,
                'invokeDeleteEvents' => false
            ],
            [
                'class' => CdnUploadImageBehavior::class,
                'attribute' => 'image',
                'scenarios' => [self::SCENARIO_DEFAULT],
                'instanceByName' => true,
                'deleteBasePathOnDelete' => false,
                'createThumbsOnSave' => false,
                'transferToCDN' => true,
                'cdnPath' => "@cdnRoot/freelancer/{freelancer_id}",
                'basePath' => "@inceRoot/freelancer/{freelancer_id}",
                'path' => "@inceRoot/freelancer/{freelancer_id}",
                'url' => "@cdnWeb/freelancer/{freelancer_id}"
            ],
        ];
    }
}