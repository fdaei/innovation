<?php

namespace common\models;

use common\behaviors\Jsonable;
use common\helpers\CoreHelper;
use Yii;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii2tech\ar\softdelete\SoftDeleteBehavior;

/**
 * This is the model class for table "{{%tags}}".
 *
 * @property int $point_id
 * @property string $name
 * @property int $type
 * @property int $frequency
 * @property string $color
 * @property int $status
 * @property int $deleted
 * @property string $description
 */
class Tag extends ActiveRecord
{
    const TYPE_RELATIONAL = 1;
    const TYPE_OCCASIONAL = 2;
    const TYPE_SPECIAL = 3;
    const TYPE_LABEL = 4;
    const TYPE_USER = 5;
    const TYPE_INVOICE_UNIQUE = 6;

    const STATUS_ACTIVE = 1;
    const STATUS_DELETED = 0;

    public static function tableName()
    {
        return '{{' . CoreHelper::getDsnAttribute('dbname', Yii::$app->db->dsn) . '}}.{{%tag}}';
    }

    public function rules()
    {
        return [
            [['name', 'type'], 'required'],
            [['frequency', 'status', 'deleted_at'], 'integer'],
            ['type', 'in', 'range' => array_keys(self::itemAlias('Type'))],
            [['status'], 'in', 'range' => array_keys(self::itemAlias('Status'))],
            ['status', 'default', 'value' => self::STATUS_ACTIVE],
            ['deleted_at', 'default', 'value' => 0],
            [['name', 'type', 'deleted_at'], 'unique', 'targetAttribute' => ['name', 'type', 'deleted_at'], 'message' => 'نوع و نام قبلا گرفته شده است!'],
            ['name', 'string', 'max' => 64],
            ['color', 'string', 'max' => 7],
            ['description', 'string', 'max' => 255]
        ];
    }



    public function attributeLabels()
    {
        return [
            'type' => Yii::t('app', 'Type'),
            'name' => Yii::t('app', 'Name'),
            'frequency' => Yii::t('app', 'Frequency'),
            'status' => Yii::t('app', 'status'),
            'color' => Yii::t('app', 'Color Id'),
            'deleted_at' => Yii::t('app', 'Deleted At'),
            'description' => Yii::t('app', 'Description')
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTagAssigns()
    {
        return $this->hasMany(TagAssign::className(), ['tag_id' => 'id']);
    }

    public static function frequentlyTags($modelClass, $type)
    {
        return self::find()
            ->select('name')
            ->leftJoin(
                TagAssign::tableName(),
                Tag::tableName() . '.tag_id=' . TagAssign::tableName() . '.tag_id'
            )->where('class=:class', [':class' => $modelClass])
            ->andWhere('type=:type', [':type' => $type])
            ->groupBy(Tag::tableName() . '.tag_id')
            ->orderBy(['frequency' => 'DESC'])
            ->limit(15)
            ->all();
    }

    public function canUpdate()
    {
        return true;
    }

    public function canDelete()
    {
        return $this->getTagAssigns()->count() == 0;
    }

    /*
* حذف منطقی
*/
    public function softDelete()
    {
        $this->status = self::STATUS_DELETED;
        $this->deleted_at = time();
        if ($this->canDelete() && $this->save()) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * {@inheritdoc}
     * @return TagQuery the active query used by this AR class.
     */
//    public static function find()
//    {
//        $query = new TagQuery(get_called_class());
//        return $query->active();
//    }

    public static function itemAlias($type, $code = NULL)
    {
        $_items = [
            'Type' => [
                self::TYPE_RELATIONAL => Yii::t("app", "Relational"),
                self::TYPE_OCCASIONAL => Yii::t("app", "Occasional"),
                self::TYPE_SPECIAL => Yii::t("app", "Special"),
                self::TYPE_LABEL => Yii::t("app", "Label"),
                self::TYPE_USER => Yii::t("app", "User"),
                self::TYPE_INVOICE_UNIQUE => Yii::t("app", "Invoice Unique")
            ],
            'TypeClass' => [
                self::TYPE_RELATIONAL => 'info',
                self::TYPE_OCCASIONAL => 'success',
                self::TYPE_SPECIAL => 'danger',
                self::TYPE_LABEL => 'primary',
            ],
            'Status' => [
                self::STATUS_ACTIVE => Yii::t("app", "Status Active"),
                self::STATUS_DELETED => Yii::t("app", "Deleted"),
            ],
            'StatusColor' => [
                self::STATUS_ACTIVE => 'success',
                self::STATUS_DELETED => 'danger',
            ],
        ];

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
}
