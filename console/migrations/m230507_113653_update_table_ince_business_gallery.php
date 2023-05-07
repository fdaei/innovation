<?php

use yii\db\Migration;

class m230507_113653_update_table_ince_business_gallery extends Migration
{
    public function safeUp()
    {
        $this->dropForeignKey('business_gallery_ibfk_3', '{{%business_gallery}}');
        $this->dropIndex('business_id', '{{%business_gallery}}');

        $this->createIndex('business_id', '{{%business_gallery}}', ['business_id']);

        $this->addForeignKey(
            'business_gallery_ibfk_3',
            '{{%business_gallery}}',
            ['business_id'],
            '{{%businesses}}',
            ['id'],
            'RESTRICT',
            'RESTRICT'
        );
    }

    public function safeDown()
    {
        $this->dropForeignKey('business_gallery_ibfk_3', '{{%business_gallery}}');
        $this->dropIndex('business_id', '{{%business_gallery}}');
        $this->createIndex('business_id', '{{%business_gallery}}', ['business_id']);
        $this->addForeignKey(
            'business_gallery_ibfk_3',
            '{{%business_gallery}}',
            ['business_id'],
            '{{%business}}',
            ['id'],
            'RESTRICT',
            'RESTRICT'
        );
    }
}