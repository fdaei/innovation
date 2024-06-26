<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "ince_log".
 *
 * @property int $id
 * @property int|null $level
 * @property string|null $category
 * @property float|null $log_time
 * @property string|null $prefix
 * @property string|null $message
 */
class Log extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'ince_log';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['level'], 'integer'],
            [['log_time'], 'number'],
            [['prefix', 'message'], 'string'],
            [['category'], 'string', 'max' => 255],
        ];
    }


    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app','ID'),
            'level' => Yii::t('app','Level'),
            'category' => Yii::t('app','Category'),
            'log_time' => Yii::t('app','Log Time'),
            'prefix' =>Yii::t('app', 'Prefix'),
            'message' => Yii::t('app','Message'),
        ];
    }


}
