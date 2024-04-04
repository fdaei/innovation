<?php

namespace common\models;

use common\behaviors\CdnUploadImageBehavior;
use common\behaviors\Jsonable;
use Yii;
use yii\base\Model;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\TimestampBehavior;
use yii\helpers\ArrayHelper;
use yii\web\UploadedFile;
use yii2tech\ar\softdelete\SoftDeleteBehavior;

/**
 * This is the model class for table "businesses_story".
 *
 * @property int $id
 * @property int $businesses_id
 * @property string $year
 * @property string $title
 * @property string $texts
 * @property string $picture
 * @property int $updated_by
 * @property int $updated_at
 * @property int $created_at
 * @property int $created_by
 * @property int $deleted_at
 */
class BusinessesStory extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%businesses_story}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['year', 'title'], 'required'],
            [['texts'], 'safe'],
            ['picture', 'image', 'extensions' => 'jpg, jpeg, png', 'maxSize' => 1024 * 1024 * 2, 'enableClientValidation' => false],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'businesses_id' => Yii::t('app', 'Businesses ID'),
            'year' => Yii::t('app', 'Year'),
            'title' => Yii::t('app', 'Title'),
            'texts' => Yii::t('app', 'Texts'),
            'picture' => Yii::t('app', 'Picture'),
            'updated_by' => Yii::t('app', 'Updated By'),
            'updated_at' => Yii::t('app', 'Updated At'),
            'created_at' => Yii::t('app', 'Created At'),
            'created_by' => Yii::t('app', 'Created By'),
            'deleted_at' => Yii::t('app', 'Deleted At'),
        ];
    }

    /**
     * {@inheritdoc}
     * @return BusinessesStoryQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new BusinessesStoryQuery(get_called_class());
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
                //'placeholder' => "/assets/images/default.jpg",
                'deleteBasePathOnDelete' => false,
                'createThumbsOnSave' => false,
                'transferToCDN' => true,
                'cdnPath' => "@cdnRoot/businesses",
                'basePath' => "@inceRoot/businesses",
                'path' => "@inceRoot/businesses",
                'url' => "@cdnWeb/businesses"
            ],
        ];
    }
}