<?php

namespace common\models;

use Yii;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\TimestampBehavior;
use yii2tech\ar\softdelete\SoftDeleteBehavior;

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
 * @property City $center
 * @property User $createdBy
 * @property User $updatedBy
 * @mixin SoftDeleteBehavior
 */
class Province extends \yii\db\ActiveRecord
{
    const STATUS_ACTIVE = 1;
    const STATUS_DELETED = 0;
    const STATUS_INACTIVE = 2;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%province}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['center_id', 'status'], 'integer'],
            [['name'], 'string', 'max' => 255],
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
     * Gets query for [[center]].
     *
     * @return \yii\db\ActiveQuery|CityQuery
     */
    public function getCenter()
    {
        return $this->hasOne(City::class, ['id' => 'center_id']);
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
    public static function find(): ProvinceQuery
    {
        $query = new ProvinceQuery(get_called_class());
        return $query->active();
    }
    public function canDelete()
    {
        $city = City::find()->active()->andWhere(['province_id' => $this->id])->limit(1)->one();

        if ($city) {
            return false;
        }
        return true;
    }
    public static function itemAlias($type, $code = NULL)
    {
        $_items = [
            'Status' => [
                self::STATUS_DELETED => Yii::t('app', 'DELETED'),
                self::STATUS_ACTIVE => Yii::t('app', 'ACTIVE'),
                self::STATUS_INACTIVE => Yii::t('app', 'INACTIVE'),
            ],
            'StatusClass' => [
                self::STATUS_DELETED => 'danger',
                self::STATUS_ACTIVE => 'success',
                self::STATUS_INACTIVE => 'warning',
            ],
            'StatusColor' => [
                self::STATUS_DELETED => '#ff5050',
                self::STATUS_ACTIVE => '#04AA6D',
                self::STATUS_INACTIVE => '#eea236',
            ],];
        if (isset($code))
            return isset($_items[$type][$code]) ? $_items[$type][$code] : false;
        else
            return isset($_items[$type]) ? $_items[$type] : false;
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
                    'status' => self::STATUS_DELETED
                ],
                'restoreAttributeValues' => [
                    'deleted_at' => 0,
                    'status' => self::STATUS_ACTIVE
                ],
                'replaceRegularDelete' => false, // mutate native `delete()` method
                'invokeDeleteEvents' => false
            ],
        ];
    }


    public function fields()
    {
        return [
            'id'=>'id',
            'name'=>'name'
        ];
    }

    public function extraFields()
    {
        return parent::extraFields(); // TODO: Change the autogenerated stub
    }

    public function setName(string $string)
    {
        $this->name=$string;
    }

    public function setCenter_id(string $string)
    {
        $this->center_id=$string;
    }

    public function setStatus(string $string)
    {
        $this->status=$string;
    }

    public function setCreated_at(string $string)
    {
        $this->created_at=$string;
    }

    public function setCreated_by( $string)
    {
        $this->created_by=$string;
    }

    public function setUpdated_at(string $string)
    {
        $this->updated_at=$string;
    }

    public function setUpdated_by( $string)
    {
        $this->updated_by=$string;
    }

    public function setDeleted_at(string $string)
    {
        $this->deleted_at=$string;
    }
}