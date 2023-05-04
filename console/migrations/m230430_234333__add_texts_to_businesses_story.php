<?php

use yii\db\Migration;
use yii\db\Expression;
/**
 * Class m230311_072035_create_table_businesses_story
 */
class m230430_234333__add_texts_to_businesses_story extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {

        $this->dropColumn('{{%businesses_story}}', 'texts');
        $this->addColumn('{{%businesses_story}}', 'texts', $this->json()->notNull()->defaultValue(new Expression('(JSON_OBJECT())')));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%businesses_story}}', 'texts');
    }
}
