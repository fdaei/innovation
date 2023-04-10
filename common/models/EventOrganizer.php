<?php

namespace common\models;

use common\behaviors\CdnUploadImageBehavior;
use Yii;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\TimestampBehavior;
use yii2tech\ar\softdelete\SoftDeleteBehavior;

/**
 * This is the model class for table "{{%event_organizer}}".
 *
 * @property int $id
 * @property string $organizer_name
 * @property string $organizer_avatar
 * @property string $organizer_picture
 * @property string $organizer_title_brief
 * @property string|null $organizer_instagram
 * @property string|null $organizer_telegram
 * @property string|null $organizer_linkedin
 * @property int $updated_at
 * @property int $updated_by
 * @property int $created_at
 * @property int $created_by
 * @property int $deleted_at
 */
class EventOrganizer extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%event_organizer}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['organizer_name', 'organizer_title_brief'], 'required'],
            [['updated_at', 'updated_by', 'created_at', 'created_by', 'deleted_at'], 'integer'],
            [['organizer_name', 'organizer_title_brief', 'organizer_instagram', 'organizer_telegram', 'organizer_linkedin'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'organizer_name' => Yii::t('app', 'Organizer Name'),
            'organizer_avatar' => Yii::t('app', 'Organizer Avatar'),
            'organizer_picture' => Yii::t('app', 'Organizer Picture'),
            'organizer_title_brief' => Yii::t('app', 'Organizer Title Brief'),
            'organizer_instagram' => Yii::t('app', 'Organizer Instagram'),
            'organizer_telegram' => Yii::t('app', 'Organizer Telegram'),
            'organizer_linkedin' => Yii::t('app', 'Organizer Linkedin'),
            'updated_at' => Yii::t('app', 'Updated At'),
            'updated_by' => Yii::t('app', 'Updated By'),
            'created_at' => Yii::t('app', 'Created At'),
            'created_by' => Yii::t('app', 'Created By'),
            'deleted_at' => Yii::t('app', 'Deleted At'),
        ];
    }

    /**
     * {@inheritdoc}
     * @return EventOrganizerQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new EventOrganizerQuery(get_called_class());
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
                'attribute' => 'organizer_avatar',
                'scenarios' => [self::SCENARIO_DEFAULT],
                'instanceByName' => false,
                //'placeholder' => "/assets/images/default.jpg",
                'deleteBasePathOnDelete' => false,
                'createThumbsOnSave' => false,
                'transferToCDN' => false,
                'cdnPath' => "@cdnRoot/event",
                'basePath' => "@inceRoot/event",
                'path' => "@inceRoot/event",
                'url' => "@cdnWeb/event"
            ],
            [
                'class' => CdnUploadImageBehavior::class,
                'attribute' => 'organizer_picture',
                'scenarios' => [self::SCENARIO_DEFAULT],
                'instanceByName' => false,
                //'placeholder' => "/assets/images/default.jpg",
                'deleteBasePathOnDelete' => false,
                'createThumbsOnSave' => false,
                'transferToCDN' => false,
                'cdnPath' => "@cdnRoot/event",
                'basePath' => "@inceRoot/event",
                'path' => "@inceRoot/event",
                'url' => "@cdnWeb/event"
            ],
        ];
    }

}
