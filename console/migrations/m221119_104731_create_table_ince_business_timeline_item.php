<?php

use yii\db\Migration;

class m221119_104731_create_table_ince_business_timeline_item extends Migration
{
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable(
            '{{%business_timeline_item}}',
            [
                'id' => $this->primaryKey()->unsigned(),
                'business_timeline_id' => $this->integer()->unsigned()->notNull(),
                'description' => $this->text()->notNull(),
                'status' => $this->tinyInteger()->notNull(),
                'created_at' => $this->integer()->unsigned()->notNull(),
                'created_by' => $this->integer()->unsigned()->notNull(),
                'updated_at' => $this->integer()->unsigned()->notNull(),
                'updated_by' => $this->integer()->unsigned()->notNull(),
                'deleted_at' => $this->integer()->unsigned()->notNull()->defaultValue('0'),
            ],
            $tableOptions
        );

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
        $this->dropTable('{{%business_timeline_item}}');
    }
}
