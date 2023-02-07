<?php

namespace common\models;

use Yii;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\TimestampBehavior;
use yii2tech\ar\softdelete\SoftDeleteBehavior;

/**
 * This is the model class for table "{{%branches_specification}}".
 *
 * @property int $id
 * @property int $branche_id
 * @property string $key
 * @property string $value
 * @property int $created_at
 * @property int $created_by
 * @property int $updated_at
 * @property int $updated_by
 * @property int $deleted_at
 *
 * @property Branches $branche
 */
class BranchesSpecification extends \yii\db\ActiveRecord
{



    public static function tableName()
    {
        return '{{%branches_specification}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [[ 'key', 'value'], 'required'],
            [['branche_id', 'created_at', 'created_by', 'updated_at', 'updated_by', 'deleted_at'], 'integer'],
            [['value'], 'string'],
            [['key'], 'string', 'max' => 255],
            [['branche_id'], 'exist', 'skipOnError' => true, 'targetClass' => Branches::class, 'targetAttribute' => ['branche_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'branche_id' => Yii::t('app', 'Branche ID'),
            'key' => Yii::t('app', 'Key'),
            'value' => Yii::t('app', 'Value'),
            'created_at' => Yii::t('app', 'Created At'),
            'created_by' => Yii::t('app', 'Created By'),
            'updated_at' => Yii::t('app', 'Updated At'),
            'updated_by' => Yii::t('app', 'Updated By'),
            'deleted_at' => Yii::t('app', 'Deleted At'),
        ];
    }

    /**
     * Gets query for [[Branche]].
     *
     * @return \yii\db\ActiveQuery|BranchesQuery
     */
    public function getBranche()
    {
        return $this->hasOne(Branches::class, ['id' => 'branche_id']);
    }

    /**
     * {@inheritdoc}
     * @return BranchesSpecificationQuery the active query used by this AR class.
     */
    public static function find()
    {
        $query = new BranchesSpecificationQuery(get_called_class());
        return $query->active();
    }

    public function canDelete()
    {
        return true;
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
        ];
    }

    public function fields()
    {
        return [
            'id',
            'branche_id',
            'key',
            'value',
        ];
    }

    public function extraFields()
    {
        return [];
    }
}
