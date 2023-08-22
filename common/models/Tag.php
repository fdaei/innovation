<?php

namespace common\models;

use common\behaviors\Jsonable;
use common\helpers\CoreHelper;
use Yii;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\helpers\Json;
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
 * @property Json $additional_data
 */
class Tag extends ActiveRecord
{
    const TYPE_RELATIONAL = 1;
    const TYPE_LABEL = 2;

    const STATUS_ACTIVE = 1;
    const STATUS_DELETED = 0;

    public static function tableName()
    {
        return '{{' . CoreHelper::getDsnAttribute('dbname', Yii::$app->db->dsn) . '}}.{{%tags}}';
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
            ['additional_data','safe']
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
            'deleted_at' => Yii::t('app', 'Deleted At')
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTagAssigns()
    {
        return $this->hasMany(TagAssign::class, ['tag_id' => 'id']);
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
    public function makeArrayOfTagId($tagSelected,$searchedTags): array
    {
        $tagIdNameMap = [];
        foreach ($searchedTags as $tag) {
            $tagIdNameMap[$tag['tag_id']] = $tag['name'];
        }
        $combinedTagInfo = [];
        foreach ($tagSelected as $tagId) {
            if (isset($tagIdNameMap[$tagId])) {
                $combinedTagInfo[] = $tagIdNameMap[$tagId];
            } else {
                $combinedTagInfo[] = $tagId;
            }
        }
        return $combinedTagInfo;
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
        if ($this->canDelete() && $this->save(false)) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * {@inheritdoc}
     * @return TagQuery the active query used by this AR class.
     */
    public static function find()
    {
        $query = new TagQuery(get_called_class());
        return $query->notDeleted();
    }

    public static function itemAlias($type, $code = NULL)
    {
        $_items = [
            'Type' => [
                self::TYPE_RELATIONAL => Yii::t("app", "Relational"),
                self::TYPE_LABEL => Yii::t("app", "Label"),

            ],
            'TypeClass' => [
                self::TYPE_RELATIONAL => 'info',
                self::TYPE_LABEL => 'primary',
            ],
            'Status' => [
                self::STATUS_ACTIVE => Yii::t("app", "Active"),
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
