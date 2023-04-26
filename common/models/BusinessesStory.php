<?php

namespace common\models;

use common\behaviors\CdnUploadImageBehavior;
use Yii;
use yii\base\Model;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\TimestampBehavior;
use yii\web\UploadedFile;
use yii2tech\ar\softdelete\SoftDeleteBehavior;

/**
 * This is the model class for table "businesses_story".
 *
 * @property int $id
 * @property int $businesses_id
 * @property string $year
 * @property string $title
 * @property string $texts
 * @property string $picture
 * @property int $updated_by
 * @property int $updated_at
 * @property int $created_at
 * @property int $created_by
 * @property int $deleted_at
 */
class BusinessesStory extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%businesses_story}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['businesses_id', 'year', 'title', 'texts'], 'required'],
            [['businesses_id', 'updated_by', 'updated_at', 'created_at', 'created_by', 'deleted_at'], 'integer'],
            [['texts'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'businesses_id' => Yii::t('app', 'Businesses ID'),
            'year' => Yii::t('app', 'Year'),
            'title' => Yii::t('app', 'Title'),
            'texts' => Yii::t('app', 'Texts'),
            'picture' => Yii::t('app', 'Picture'),
            'updated_by' => Yii::t('app', 'Updated By'),
            'updated_at' => Yii::t('app', 'Updated At'),
            'created_at' => Yii::t('app', 'Created At'),
            'created_by' => Yii::t('app', 'Created By'),
            'deleted_at' => Yii::t('app', 'Deleted At'),
        ];
    }

    /**
     * {@inheritdoc}
     * @return BusinessesStoryQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new BusinessesStoryQuery(get_called_class());
    }
    public static function handelData($bid,$defaultData = []){
        $postData = \common\models\Model::createMultiple(self::className());
        Model::loadMultiple($postData, Yii::$app->request->post());
        $headlinesJson = [];
        foreach ($postData as $index => $eachData) {
            $eachData->businesses_id = $bid;
            $eachData->texts = explode(PHP_EOL,$eachData->texts);
            $eachData->save();
        }
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
            [
                'class' => CdnUploadImageBehavior::class,
                'attribute' => 'picture',
                'scenarios' => [self::SCENARIO_DEFAULT],
                'instanceByName' => false,
                //'placeholder' => "/assets/images/default.jpg",
                'deleteBasePathOnDelete' => false,
                'createThumbsOnSave' => false,
                'transferToCDN' => true,
                'cdnPath' => "@cdnRoot/BusinessesStory",
                'basePath' => "@inceRoot/BusinessesStory",
                'path' => "@inceRoot/BusinessesStory",
                'url' => "@cdnWeb/BusinessesStory"
            ],
        ];
    }

    public static function loadDefaultValue($id){
        $datas = BusinessesStory::find()->where(['businesses_id'=>$id])->asArray()->all();
        $arrayData = [];
        for ($i = 0; $i < count($datas); $i++) {
            $arrayData[$i] = new self();
            $arrayData[$i]->attributes = $datas[$i];
            $texts = $arrayData[$i]->attributes['texts'];
            $arrayData[$i]->texts = implode(PHP_EOL,json_decode($texts,1));
        }
        if(empty($arrayData)){
            $arrayData = [new self()];
        }
//        print_r($arrayData); die;
        return $arrayData;

    }
}
