<?php

namespace backend\models;
use aminbbb92\user\models\User;
use Yii;
use yii\behaviors\TimestampBehavior;
use yii2tech\ar\softdelete\SoftDeleteBehavior;

/**
 * This is the model class for table "city".
 *
 * @property int $id
 * @property int $province_id
 * @property string $name
 * @property int $latitude
 * @property int $logitude
 * @property int $status
 * @property int $created_at
 * @property int $created_by
 * @property int $updated_at
 * @property int $updated_by
 * @property int $deleted_at
 *
 * @property User $createdBy
 * @property Province $province
 * @property User $updatedBy
 */
class City extends \yii\db\ActiveRecord
{
    const STATUS_ACTIVE = 1;
    const STATUS_DELETED = 0;
    const STATUS_INACTIVE = 2;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {

        return '{{%city}}';
    }
    public function behaviors()
    {
        return [
            'timestamp' => [
                'class' => TimestampBehavior::className()
            ], 'softDeleteBehavior' => [
                'class' => SoftDeleteBehavior::className(),
                'softDeleteAttributeValues' => [
                    'deleted_at' => time(),
                    'status' => self::STATUS_DELETED
                ],
            ],
        ];
    }
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['province_id', 'name', 'latitude', 'logitude', 'status', 'created_by', 'updated_by'], 'required'],
            [['province_id', 'latitude', 'logitude', 'status',  'created_by', 'updated_by', 'deleted_at'], 'integer'],
            [['name'], 'string', 'max' => 255],
            [['province_id'], 'exist', 'skipOnError' => true, 'targetClass' => Province::class, 'targetAttribute' => ['province_id' => 'id']],
//            [['created_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['created_by' => 'id']],
//            [['updated_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['updated_by' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'province_id' => Yii::t('app', 'Province ID'),
            'name' => Yii::t('app', 'Name'),
            'latitude' => Yii::t('app', 'Latitude'),
            'logitude' => Yii::t('app', 'Logitude'),
            'status' => Yii::t('app', 'Status'),
            'created_at' => Yii::t('app', 'Created At'),
            'created_by' => Yii::t('app', 'Created By'),
            'updated_at' => Yii::t('app', 'Updated At'),
            'updated_by' => Yii::t('app', 'Updated By'),
            'deleted_at' => Yii::t('app', 'Deleted At'),
        ];
    }
    /**
     * Gets query for [[CreatedBy]].
     *
     * @return \yii\db\ActiveQuery|UserQuery
     */
    public function getCreatedBy()
    {
        return $this->hasOne(User::class, ['id' => 'created_by']);
    }

    /**
     * Gets query for [[Province]].
     *
     * @return \yii\db\ActiveQuery|ProvinceQuery
     */
    public function getProvince()
    {
        return $this->hasOne(Province::class, ['id' => 'province_id']);
    }

    /**
     * Gets query for [[UpdatedBy]].
     *
     * @return \yii\db\ActiveQuery|UserQuery
     */
    public function getUpdatedBy()
    {
        return $this->hasOne(User::class, ['id' => 'updated_by']);
    }

    /**
     * {@inheritdoc}
     * @return ProvinceQuery the active query used by this AR class.
     */
    public static function find()
    {
        $query = new ProvinceQuery(get_called_class());
        return $query->active();
    }
}
