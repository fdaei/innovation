<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "province".
 *
 * @property int $id
 * @property string $name
 * @property int $center_id
 * @property int $status
 * @property int $created_at
 * @property int $created_by
 * @property int $updated_at
 * @property int $updated_by
 * @property int $deleted_at
 *
 * @property City[] $cities
 * @property User $createdBy
 * @property User $updatedBy
 */
class Province extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'province';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'center_id', 'status', 'created_at', 'created_by', 'updated_at', 'updated_by', 'deleted_at'], 'required'],
            [['center_id', 'status', 'created_at', 'created_by', 'updated_at', 'updated_by', 'deleted_at'], 'integer'],
            [['name'], 'string', 'max' => 255],
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
            'name' => Yii::t('app', 'Name'),
            'center_id' => Yii::t('app', 'Center ID'),
            'status' => Yii::t('app', 'Status'),
            'created_at' => Yii::t('app', 'Created At'),
            'created_by' => Yii::t('app', 'Created By'),
            'updated_at' => Yii::t('app', 'Updated At'),
            'updated_by' => Yii::t('app', 'Updated By'),
            'deleted_at' => Yii::t('app', 'Deleted At'),
        ];
    }

    /**
     * Gets query for [[Cities]].
     *
     * @return \yii\db\ActiveQuery|ProvinceQuery
     */
    public function getCities()
    {
        return $this->hasMany(City::class, ['province_id' => 'id']);
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
        return new ProvinceQuery(get_called_class());
    }
}
