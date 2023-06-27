<?php

namespace common\models;

use common\helpers\CoreHelper;
use yii\db\ActiveRecord;
use Yii;

class TagAssign extends ActiveRecord
{
    public static function tableName()
    {
        return '{{' . CoreHelper::getDsnAttribute('dbname', Yii::$app->db->dsn) . '}}.{{%tags_assign}}';
    }

    public static function batchAssign($item_ids, $tag_ids, $class)
    {
        $data = [];
        foreach ($item_ids as $item_id) {
            foreach ($tag_ids as $tag_id) {
                $data[] = ['item_id' => (int)$item_id, 'tag_id' => (int)$tag_id, 'class' => $class];
            }
        }

        $command = Yii::$app->db->createCommand()->batchInsert(

            TagAssign::tableName(),

            array_keys($data[0]),

            $data

        );

        $sql = $command->getRawSql();

        $sql .= ' ON DUPLICATE KEY UPDATE id=id';

        $command->setRawSql($sql);
        return $command->execute();
    }
}
