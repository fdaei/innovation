<?php

use yii\db\Migration;

class m230507_103253_update_table_ince_business_member extends Migration
{
    public function safeUp()
    {
        $this->dropForeignKey('ince_business_member_ibfk_1', '{{%business_member}}');
        $this->dropIndex('business_id', '{{%business_member}}');

        $this->createIndex('business_id', '{{%business_member}}', ['business_id']);

        $this->addForeignKey(
            'ince_business_member_ibfk_1',
            '{{%business_member}}',
            ['business_id'],
            '{{%businesses}}',
            ['id'],
            'RESTRICT',
            'RESTRICT'
        );
    }

    public function safeDown()
    {
        $this->dropForeignKey('ince_business_member_ibfk_1', '{{%business_member}}');
        $this->dropIndex('business_id', '{{%business_member}}');
        $this->createIndex('business_id', '{{%business_member}}', ['business_id']);
        $this->addForeignKey(
            'ince_business_member_ibfk_1',
            '{{%business_member}}',
            ['business_id'],
            '{{%business}}',
            ['id'],
            'RESTRICT',
            'RESTRICT'
        );
    }
}