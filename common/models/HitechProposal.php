<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "{{%hitech_proposal}}".
 *
 * @property int $id
 * @property int|null $hitech_id
 * @property string|null $name
 * @property string|null $mobile
 * @property string|null $description
 * @property int|null $status
 * @property int|null $updated_at
 * @property int|null $created_at
 * @property int $deleted_at
 */
class HitechProposal extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%hitech_proposal}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['hitech_id', 'name', 'mobile'], 'required'],
            [['hitech_id', 'status'], 'integer'],
            [['description'], 'string'],
            [['name', 'mobile'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'hitech_id' => Yii::t('app', 'Hitech ID'),
            'name' => Yii::t('app', 'Name'),
            'mobile' => Yii::t('app', 'Mobile'),
            'description' => Yii::t('app', 'Description'),
            'status' => Yii::t('app', 'Status'),
            'updated_at' => Yii::t('app', 'Updated At'),
            'created_at' => Yii::t('app', 'Created At'),
            'deleted_at' => Yii::t('app', 'Deleted At'),
        ];
    }
    public function behaviors()
    {
        return [
            'timestamp' => [
                'class' => TimestampBehavior::class
            ],
        ];
    }
}
