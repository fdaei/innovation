<?php

namespace common\models;

use Yii;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\TimestampBehavior;
use yii2tech\ar\softdelete\SoftDeleteBehavior;

/**
 * This is the model class for table "{{%branches_admin}}".
 *
 * @property int $branche_id
 * @property int $admin_id
 *
 * @property User $admin
 * @property Branches $branche
 */
class BranchesAdmin extends \yii\db\ActiveRecord
{


    public static function tableName()
    {
        return '{{%branches_admin}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['branche_id', 'admin_id'], 'integer'],
            [['admin_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['admin_id' => 'id']],
            [['branche_id'], 'exist', 'skipOnError' => true, 'targetClass' => Branches::class, 'targetAttribute' => ['branche_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'branche_id' => Yii::t('app', 'Branche ID'),
            'admin_id' => Yii::t('app', 'Admin ID'),
        ];
    }

    /**
     * Gets query for [[Admin]].
     *
     * @return \yii\db\ActiveQuery|yii\db\ActiveQuery
     */
    public function getAdmin()
    {
        return $this->hasOne(User::class, ['id' => 'admin_id']);
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
     * @return BranchesAdminQuery the active query used by this AR class.
     */
    public static function find()
    {
        $query = new BranchesAdminQuery(get_called_class());
        return $query;
    }

}
