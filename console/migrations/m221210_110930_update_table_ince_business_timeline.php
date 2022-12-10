<?php

use yii\db\Migration;

class m221210_110930_update_table_ince_business_timeline extends Migration
{
    public function safeUp()
    {
        $this->dropIndex('year', '{{%business_timeline}}');

        $this->createIndex('year', '{{%business_timeline}}', ['year', 'business_id'], true);
    }

    public function safeDown()
    {
        $this->dropIndex('year', '{{%business_timeline}}');

        $this->createIndex('year', '{{%business_timeline}}', ['year'], true);
    }
}
