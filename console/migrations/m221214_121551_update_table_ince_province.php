<?php

use yii\db\Migration;

class m221214_121551_update_table_ince_province extends Migration
{
    public function safeUp()
    {
        $this->dropIndex('name', '{{%province}}');

        $this->createIndex('name', '{{%province}}', ['name', 'deleted_at'], true);
    }

    public function safeDown()
    {
        $this->dropIndex('name', '{{%province}}');

        $this->createIndex('name', '{{%province}}', ['name'], true);
    }
}