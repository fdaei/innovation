<?php

use yii\db\Migration;

class m221102_082953_create_table_business_stat extends Migration
{
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable(
            '{{%business_stat}}',
            [
                'id' => $this->primaryKey(),
                'business_id' => $this->integer()->notNull(),
                'type' => $this->string()->notNull(),
                'title' => $this->string()->notNull(),
                'subtitle' => $this->string()->notNull(),
                'icon' => $this->string()->notNull(),
                'status' => $this->boolean()->notNull(),
                'created_at' => $this->integer()->unsigned()->notNull(),
                'created_by' => $this->integer()->notNull(),
                'update_at' => $this->integer()->unsigned()->notNull(),
                'update_by' => $this->integer()->notNull(),
                'deleted_at' => $this->integer()->unsigned()->notNull(),
            ],
            $tableOptions
        );

        $this->createIndex('business_id', '{{%business_stat}}', ['business_id']);
        $this->createIndex('business_stat_ibfk_2', '{{%business_stat}}', ['created_by']);
        $this->createIndex('business_stat_ibfk_3', '{{%business_stat}}', ['update_by']);
    }

    public function safeDown()
    {
        $this->dropTable('{{%business_stat}}');
    }
}
