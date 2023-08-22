<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%profile}}".
 *
 * @property int $user_id
 * @property string|null $public_email
 * @property string|null $gravatar_email
 * @property string|null $gravatar_id
 * @property string|null $location
 * @property string|null $website
 * @property string|null $bio
 * @property string|null $timezone
 * @property string|null $first_name
 * @property string|null $last_name
 *
 * @property User $user
 */
class Profile extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%profile}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['bio'], 'string'],
            [['public_email', 'gravatar_email', 'location', 'website'], 'string', 'max' => 255],
            [['gravatar_id'], 'string', 'max' => 32],
            [['timezone'], 'string', 'max' => 40],
            [['first_name', 'last_name'], 'string', 'max' => 64],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'user_id' => Yii::t('app', 'User ID'),
            'public_email' => Yii::t('app', 'Public Email'),
            'gravatar_email' => Yii::t('app', 'Gravatar Email'),
            'gravatar_id' => Yii::t('app', 'Gravatar ID'),
            'location' => Yii::t('app', 'Location'),
            'website' => Yii::t('app', 'Website'),
            'bio' => Yii::t('app', 'Bio'),
            'timezone' => Yii::t('app', 'Timezone'),
            'first_name' => Yii::t('app', 'First Name'),
            'last_name' => Yii::t('app', 'Last Name'),
        ];
    }

    /**
     * Gets query for [[User]].
     *
     * @return \yii\db\ActiveQuery|yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::class, ['id' => 'user_id'])->inverseOf('profile');
    }

    /**
     * {@inheritdoc}
     * @return ProfileQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ProfileQuery(get_called_class());
    }
}
