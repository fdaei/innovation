<?php

namespace common\models;

use Yii;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveQuery;
use yii\helpers\HtmlPurifier;
use yii2tech\ar\softdelete\SoftDeleteBehavior;

/**
 * This is the model class for table "{{%Activity_comment}}".
 *
 * @property int $id
 * @property int $Activity_id
 * @property int $created_by
 * @property int $updated_by
 * @property string $comment
 * @property int $created_at
 * @property int $updated_at
 * @property int|null $deleted_at
 *
 * @property User $createdBy
 * @property Activity $Activity
 * @mixin TimestampBehavior
 * @mixin BlameableBehavior
 * @mixin SoftDeleteBehavior
 */
class ActivityComment extends \yii\db\ActiveRecord
{

    /**
     * {@inheritdoc}
     */
    const STATUS_ACTIVE = 1;
    const STATUS_DELETED = 0;
    const STATUS_INACTIVE = 2;


    public static function tableName(): string
    {
        return '{{%activity_comment}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules(): array
    {
        return [
            [[ 'comment'], 'required'],
            [['activity_id','created_at', 'updated_at', 'deleted_at'], 'integer'],
            [['comment'], 'string', 'max' => 1500],
            [['created_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['created_by' => 'id']],
            [['updated_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['updated_by' => 'id']],
            [['activity_id'], 'exist', 'skipOnError' => true, 'targetClass' => Activity::class, 'targetAttribute' => ['activity_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels(): array
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'activity_id' => Yii::t('app', 'Activity ID'),
            'created_by' => Yii::t('app', 'Created By'),
            'updated_by' => Yii::t('app', 'Updated By'),
            'comment' => Yii::t('app', 'Comment'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
            'deleted_at' => Yii::t('app', 'Deleted At'),
        ];
    }

    /**
     * Gets query for [[CreatedBy]].
     *
     * @return \yii\db\ActiveQuery|yii\db\ActiveQuery
     */
    public function getCreatedBy():ActiveQuery
    {
        return $this->hasOne(User::class, ['id' => 'created_by']);
    }
    public function getUpadatedBy(): ActiveQuery
    {
        return $this->hasOne(User::class, ['id' => 'updated_by']);
    }
    /**
     * Gets query for [[Activity]].
     *
     * @return \yii\db\ActiveQuery|ActivityQuery
     */
    public function getActivity(): ActiveQuery|ActivityQuery
    {
        return $this->hasOne(Activity::class, ['id' => 'activity_id']);
    }

    /**
     * {@inheritdoc}
     * @return ActivityCommentQuery the active query used by this AR class.
     */
    public static function find(): ActivityCommentQuery
    {
        $query = new ActivityCommentQuery(get_called_class());
        return $query->notDeleted();
    }

    public function canDelete(): bool
    {
        return true;
    }
    public function beforeSave($insert): bool
    {
        $this->comment = HtmlPurifier::process($this->comment);
        return parent::beforeSave($insert);
    }
    public function behaviors(): array
    {
        return [
            'timestamp' => [
                'class' => TimestampBehavior::class
            ],
            'blameable' => [
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
                'replaceRegularDelete' => false,
                'invokeDeleteEvents' => false
            ],
        ];
    }


    public function fields(): array
    {
        return [
            'comment',
        ];
    }

    public function extraFields(): array
    {
        return [];
    }
}
