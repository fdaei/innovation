<?php

use yii\db\Migration;

class m221117_070239_create_table_ince_business_member extends Migration
{
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable(
            '{{%business_member}}',
            [
                'first_name' => $this->string(64)->notNull(),
                'last_name' => $this->string(64)->notNull(),
                'image' => $this->string(128)->notNull(),
                'position' => $this->string(64)->notNull(),
                'id' => $this->primaryKey()->unsigned(),
                'business_id' => $this->integer()->unsigned()->notNull(),
            ],
            $tableOptions
        );

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

    public function safeDown()
    {
        $this->dropTable('{{%business_member}}');
    }
}
