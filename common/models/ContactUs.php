<?php

namespace common\models;

use common\behaviors\CdnUploadImageBehavior;
use Yii;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\TimestampBehavior;
use yii2tech\ar\softdelete\SoftDeleteBehavior;

/**
 * This is the model class for table "{{%contact_us}}".
 *
 * @property int $id
 * @property string $name
 * @property string $mobile
 * @property int $title
 * @property string|null $description_user
 * @property string $file
 * @property int $status
 * @property int|null $updated_by
 * @property int|null $updated_at
 * @property int $created_at
 * @property int $deleted_at
 *
 * @mixin TimestampBehavior
 * @mixin BlameableBehavior
 */
class ContactUs extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%contact_us}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'mobile', 'title','description_user'], 'required'],
            [['status', 'updated_by', 'updated_at', 'created_at', 'deleted_at'], 'integer'],
            [['title','description_user'], 'string'],
            [['name', 'mobile', 'file'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'name' => Yii::t('app', 'Name'),
            'mobile' => Yii::t('app', 'Mobile'),
            'title' => Yii::t('app', 'Title'),
            'description_user' => Yii::t('app', 'Description User'),
            'file' => Yii::t('app', 'File'),
            'status' => Yii::t('app', 'Status'),
            'updated_by' => Yii::t('app', 'Updated By'),
            'updated_at' => Yii::t('app', 'Updated At'),
            'created_at' => Yii::t('app', 'Created At'),
            'deleted_at' => Yii::t('app', 'Deleted At'),
        ];
    }

    /**
     * {@inheritdoc}
     * @return ContactUsQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ContactUsQuery(get_called_class());
    }
    public function behaviors()
    {
        return [
            'timestamp' => [
                'class' => TimestampBehavior::class
            ],
            [
                'class' => BlameableBehavior::class,
                'createdByAttribute' => null,
                'updatedByAttribute' => 'updated_by',
            ],
        ];
    }
}
