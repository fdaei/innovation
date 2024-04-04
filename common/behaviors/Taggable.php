<?php

namespace common\behaviors;

use common\models\Tag;
use common\models\TagAssign;
use Yii;
use yii\db\ActiveRecord;
use yii\helpers\ArrayHelper;

/**
 *
 * @property array $_tags
 * @property array $_old_tags
 * @property string $deleteTagsScenario
 *
 * @property TagAssign[] $tagAssigns
 * @property Tag[] $tags
 * @property array $tagNames
 * @property string $tagsString
 * @property string $oldTagNames
 * @property array $tagsArray
 * @property array $oldTagsArray
 *
 * @author SADi <sadshafiei.01@gmail.com>
 */
class Taggable extends \yii\base\Behavior
{
    private $_tags;
    private $_old_tags;
    public $deleteTagsScenario = 'delete_tags_on_update';
    public $classAttribute = '';
    public function events()
    {
        return [
            ActiveRecord::EVENT_AFTER_INSERT => 'afterInsert',
            ActiveRecord::EVENT_AFTER_UPDATE => 'afterUpdate',
            ActiveRecord::EVENT_BEFORE_DELETE => 'beforeDelete',
        ];
    }
    private function getClass()
    {
        return $this->classAttribute ? $this->classAttribute : get_class($this->owner);
    }

    public function getTagAssigns()
    {
        return $this->owner->hasMany(TagAssign::class, ['item_id' => $this->owner->primaryKey()[0]])
            ->andOnCondition(['class' => $this->getClass()]);
    }

    public function getTags($type = null)
    {
        $query = $this->owner->hasMany(Tag::class, ['tag_id' => 'tag_id'])
            ->via('tagAssigns');

        return $type ? $query->andWhere([Tag::tableName() . '.type' => $type]) : $query;
    }

    public function getTagsString($type = null, $glue = ', ')
    {
        return implode($glue, ArrayHelper::map($this->getTags()->all(), 'name', 'name'));
    }

    public function getTagNames($type = null, $glue = ', ')
    {
        return ArrayHelper::map($this->getTagsArray($type), 'id', 'id');
    }

    public function setTagNames($values)
    {
        $this->_tags = $this->filterTagValues($values);
    }

    public function getOldTagNames($type = null, $glue = ', ')
    {
        return implode($glue, $this->getOldTagsArray($type));
    }

    public function setOldTagNames($values)
    {
        $this->_old_tags = $this->filterTagValues($values);
    }

    public function getTagsArray($type = null)
    {
        if ($this->_tags === null) {
            $this->_tags = [];
            foreach ($this->owner->getTags($type)->all() as $tag) {
                $this->_tags[] = ['id' => $tag->tag_id, 'name' => $tag->name];
            }
        }
        return $this->_tags;
    }

    public function getOldTagsArray($type = null)
    {
        if ($this->_old_tags === null) {
            $this->_old_tags = [];
            foreach ($this->owner->getTags($type)->all() as $tag) {
                $this->_old_tags[] = $tag->tag_id;
            }
        }
        return $this->_old_tags;
    }

    public function afterUpdate()
    {
        if ($this->owner->scenario !== $this->deleteTagsScenario) {
            return false;
        } else {
            //$this->beforeDelete();
        }
        $this->afterInsert();
    }

    public function afterInsert()
    {
        $this->_tags = is_array($this->_tags) ? $this->_tags : [];
        $tagAssigns = [];
        $modelClass = $this->getClass();
        $oldTags = $this->oldTagsArray;
        $newTags = array_diff($this->_tags, $oldTags);
        $deletedTags = array_diff($oldTags, $this->_tags);

        if (!empty($deletedTags)) {
            TagAssign::deleteAll([
                'tag_id' => $deletedTags,
                'item_id' => $this->owner->primaryKey,
                'class' => $modelClass
            ]);
        }

        foreach ($newTags as $id) {
            if (($tag = Tag::findOne($id))) {
                $tag->frequency++;
                if ($tag->save()) {
                    $updatedTags[] = $tag;
                    $tagAssigns[] = [$modelClass, $this->owner->primaryKey, $tag->tag_id];
                }
            }
        }

        if (count($tagAssigns)) {
            Yii::$app->db->createCommand()->batchInsert(TagAssign::tableName(), ['class', 'item_id', 'tag_id'], $tagAssigns)->execute();
            $this->owner->populateRelation('tags', $updatedTags);
        }
    }

    public function beforeDelete()
    {
        $pks = [];

        foreach ($this->owner->tags as $tag) {
            $pks[] = $tag->primaryKey;
        }

        if (count($pks)) {
            Tag::updateAllCounters(['frequency' => -1], ['in', 'tag_id', $pks]);
        }
        Tag::deleteAll(['frequency' => 0]);
        TagAssign::deleteAll(['class' => $this->getClass(), 'item_id' => $this->owner->primaryKey]);
    }

    /**
     * Filters tags.
     * @param string|string[] $values
     * @return string[]
     */
    public function filterTagValues($values)
    {
        return array_unique(preg_split(
            '/\s*,\s*/u',
            preg_replace('/\s+/u', ' ', is_array($values) ? implode(',', $values) : $values),
            -1,
            PREG_SPLIT_NO_EMPTY
        ));
    }
}
