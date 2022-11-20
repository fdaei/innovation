<?php

use yii\db\Migration;

class m221120_094522_update_table_ince_business_timeline extends Migration
{
    public function safeUp()
    {
        $this->dropForeignKey('ince_business_timeline_item_ibfk_1', '{{%business_timeline_item}}');
        $this->dropPrimaryKey('PRIMARY', '{{%business_timeline}}');
        $this->alterColumn('{{%business_timeline}}', 'id', $this->primaryKey()->unsigned());

        $this->addForeignKey(
            'ince_business_timeline_item_ibfk_1',
            '{{%business_timeline_item}}',
            ['business_timeline_id'],
            '{{%business_timeline}}',
            ['id'],
            'RESTRICT',
            'RESTRICT'
        );
    }

    public function safeDown()
    {
        $this->alterColumn('{{%business_timeline}}', 'id', $this->primaryKey());
    }
}