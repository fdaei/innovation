<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "business_stat".
 *
 * @property int $id
 * @property int $business_id
 * @property string $type
 * @property string $title
 * @property string $subtitle
 * @property string $icon
 * @property int $status
 * @property int $created_at
 * @property int $created_by
 * @property int $update_at
 * @property int $update_by
 * @property int $deleted_at
 */
class BusinessStat extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'business_stat';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'business_id', 'type', 'title', 'subtitle', 'icon', 'status', 'created_at', 'created_by', 'update_at', 'update_by', 'deleted_at'], 'required'],
            [['id', 'business_id', 'status', 'created_at', 'created_by', 'update_at', 'update_by', 'deleted_at'], 'integer'],
            [['type', 'title', 'subtitle', 'icon'], 'string', 'max' => 255],
            [['id'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'business_id' => Yii::t('app', 'Business ID'),
            'type' => Yii::t('app', 'Type'),
            'title' => Yii::t('app', 'Title'),
            'subtitle' => Yii::t('app', 'Subtitle'),
            'icon' => Yii::t('app', 'Icon'),
            'status' => Yii::t('app', 'Status'),
            'created_at' => Yii::t('app', 'Created At'),
            'created_by' => Yii::t('app', 'Created By'),
            'update_at' => Yii::t('app', 'Update At'),
            'update_by' => Yii::t('app', 'Update By'),
            'deleted_at' => Yii::t('app', 'Deleted At'),
        ];
    }

    /**
     * {@inheritdoc}
     * @return BusinessStatQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new BusinessStatQuery(get_called_class());
    }
}
