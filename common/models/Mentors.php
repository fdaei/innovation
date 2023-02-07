<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "mentors".
 *
 * @property int $user_id
 * @property string|null $name
 * @property string|null $telegram
 * @property string|null $instagram
 * @property string|null $whatsapp
 * @property string|null $activity_field
 * @property string|null $profile_pic
 * @property string|null $activity_description
 * @property float|null $consulting_fee
 * @property int|null $consultation_face_to_face
 * @property int|null $consultation_online
 * @property string|null $services
 * @property string|null $records
 * @property int $status
 * @property int $updated_at
 * @property int $updated_by
 * @property int $created_by
 * @property int $created_at
 * @property int|null $deleted_at
 */
class Mentors extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'mentors';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['activity_description'], 'string'],
            [['consulting_fee'], 'number'],
            [['consultation_face_to_face', 'consultation_online', 'status', 'updated_at', 'updated_by', 'created_by', 'created_at', 'deleted_at'], 'integer'],
            [['services', 'records'], 'safe'],
            [['status', 'updated_at', 'updated_by', 'created_by', 'created_at'], 'required'],
            [['name', 'telegram', 'instagram', 'whatsapp', 'activity_field', 'profile_pic'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'user_id' => 'User ID',
            'name' => 'Name',
            'telegram' => 'Telegram',
            'instagram' => 'Instagram',
            'whatsapp' => 'Whatsapp',
            'activity_field' => 'Activity Field',
            'profile_pic' => 'Profile Pic',
            'activity_description' => 'Activity Description',
            'consulting_fee' => 'Consulting Fee',
            'consultation_face_to_face' => 'Consultation Face To Face',
            'consultation_online' => 'Consultation Online',
            'services' => 'Services',
            'records' => 'Records',
            'status' => 'Status',
            'updated_at' => 'Updated At',
            'updated_by' => 'Updated By',
            'created_by' => 'Created By',
            'created_at' => 'Created At',
            'deleted_at' => 'Deleted At',
        ];
    }

    /**
     * {@inheritdoc}
     * @return MentorsQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new MentorsQuery(get_called_class());
    }
}
