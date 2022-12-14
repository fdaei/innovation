<?php

use yii\db\Migration;

class m221214_122320_update_table_ince_city extends Migration
{
    public function safeUp()
    {
        $this->createIndex('unique_name', '{{%city}}', ['name', 'deleted_at', 'province_id'], true);
    }

    public function safeDown()
    {
        $this->dropIndex('unique_name', '{{%city}}');
    }
}