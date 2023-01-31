<?php

namespace common\models;

use common\behaviors\CdnUploadImageBehavior;
use Yii;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\TimestampBehavior;
use yii2tech\ar\softdelete\SoftDeleteBehavior;

/**
* This is the model class for table "{{%statuses}}".
*
    * @property int $id
    * @property string $title_fa
    * @property string $title_en
    * @property string $type
    * @property string created_by
 *  @property string updated_by
 *  @property string created_at
 *  @property string updated_at
 *  @property string deleted_at
*/
class Statuses extends \yii\db\ActiveRecord
{

/**
* {@inheritdoc}
*/



public static function tableName()
{
return '{{%statuses}}';
}

/**
* {@inheritdoc}
*/
public function rules()
{
return [
            [['title_fa', 'title_en', 'type'], 'required'],
            [['title_fa', 'title_en'], 'string', 'max' => 256],
            [['type'], 'string', 'max' => 255],
        ];
}

/**
* {@inheritdoc}
*/
public function attributeLabels()
{
return [
    'id' => Yii::t('app', 'ID'),
    'title_fa' => Yii::t('app', 'Title Fa'),
    'title_en' => Yii::t('app', 'Title En'),
    'type' => Yii::t('app', 'Type'),
];
}
    
    /**
    * {@inheritdoc}
    * @return StatusesQuery the active query used by this AR class.
    */
    public static function find()
    {
    $query = new StatusesQuery(get_called_class());
    return $query;
    }
    public function getModels(){
        return ['activity'=>'activity','test1'=>'test1','test2'=>'test2'];
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
            'id' ,
            'title_fa' ,
            'title_en' ,
            'type' ,
        ];
    }

    public function extraFields()
    {
    return [];
    }
}
