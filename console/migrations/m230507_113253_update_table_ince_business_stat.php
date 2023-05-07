<?php

use yii\db\Migration;

class m230507_113253_update_table_ince_business_stat extends Migration
{
    public function safeUp()
    {
        $this->dropForeignKey('business_stat_ibfk_3', '{{%business_stat}}');
        $this->dropIndex('business_id', '{{%business_stat}}');

        $this->createIndex('business_id', '{{%business_stat}}', ['business_id']);

        $this->addForeignKey(
            'business_stat_ibfk_3',
            '{{%business_stat}}',
            ['business_id'],
            '{{%businesses}}',
            ['id'],
            'RESTRICT',
            'RESTRICT'
        );
    }

    public function safeDown()
    {
        $this->dropForeignKey('business_stat_ibfk_3', '{{%business_stat}}');
        $this->dropIndex('business_id', '{{%business_stat}}');
        $this->createIndex('business_id', '{{%business_stat}}', ['business_id']);
        $this->addForeignKey(
            'business_stat_ibfk_3',
            '{{%business_stat}}',
            ['business_id'],
            '{{%business}}',
            ['id'],
            'RESTRICT',
            'RESTRICT'
        );
    }
}