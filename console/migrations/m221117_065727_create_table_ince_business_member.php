<?php

use yii\db\Migration;

class m221117_065727_create_table_ince_business_member extends Migration
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
            ],
            $tableOptions
        );
    }

    public function safeDown()
    {
        $this->dropTable('{{%business_member}}');
    }
}
