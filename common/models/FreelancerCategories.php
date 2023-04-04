<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%freelancer_categories}}".
 *
 * @property int $id
 * @property int $freelancer_id
 * @property int $categories_id
 */
class FreelancerCategories extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%freelancer_categories}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['freelancer_id', 'categories_id'], 'required'],
            [['freelancer_id', 'categories_id'], 'integer'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'freelancer_id' => Yii::t('app', 'Freelancer ID'),
            'categories_id' => Yii::t('app', 'Categories ID'),
        ];
    }

    /**
     * {@inheritdoc}
     * @return FreelancerCategoriesQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new FreelancerCategoriesQuery(get_called_class());
    }
}
