<?php

use yii\db\Migration;

class m230507_113553_update_table_ince_business_timeline extends Migration
{
    public function safeUp()
    {
        $this->dropForeignKey('business_timeline_ibfk_1', '{{%business_timeline}}');
        $this->dropIndex('business_id', '{{%business_timeline}}');

        $this->createIndex('business_id', '{{%business_timeline}}', ['business_id']);

        $this->addForeignKey(
            'business_timeline_ibfk_1',
            '{{%business_timeline}}',
            ['business_id'],
            '{{%businesses}}',
            ['id'],
            'RESTRICT',
            'RESTRICT'
        );
    }

    public function safeDown()
    {
        $this->dropForeignKey('business_timeline_ibfk_1', '{{%business_timeline}}');
        $this->dropIndex('business_id', '{{%business_timeline}}');
        $this->createIndex('business_id', '{{%business_timeline}}', ['business_id']);
        $this->addForeignKey(
            'business_timeline_ibfk_1',
            '{{%business_timeline}}',
            ['business_id'],
            '{{%business}}',
            ['id'],
            'RESTRICT',
            'RESTRICT'
        );
    }
}