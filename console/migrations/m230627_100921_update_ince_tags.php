<?php

use yii\db\Migration;

/**
 * Class m230627_100921_update_ince_event
 */
class m230627_100921_update_ince_tags extends Migration
{
    public function safeUp()
    {
        $this->alterColumn('{{%tags}}', 'additional_data', $this->json()->notNull()->defaultExpression('(JSON_OBJECT())'));
    }

    public function safeDown()
    {
        $this->alterColumn('{{%tags}}', 'additional_data', $this->json()->notNull());
    }
}