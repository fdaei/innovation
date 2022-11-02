<?php

use yii\db\Migration;

class m221102_100712_create_table_business_gallery extends Migration
{
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable(
            '{{%business_gallery}}',
            [
                'id' => $this->primaryKey(),
                'business_id' => $this->integer()->notNull(),
                'image' => $this->string()->notNull(),
                'title' => $this->string()->notNull(),
                'description' => $this->text()->notNull(),
                'status' => $this->boolean()->notNull(),
                'created_at' => $this->integer()->unsigned()->notNull(),
                'created_by' => $this->integer()->unsigned()->notNull(),
                'updated_at' => $this->integer()->unsigned()->notNull(),
                'updated_by' => $this->integer()->unsigned()->notNull(),
                'deleted_at' => $this->integer()->unsigned()->notNull(),
            ],
            $tableOptions
        );

        $this->createIndex('business_id', '{{%business_gallery}}', ['business_id']);
        $this->createIndex('created_by', '{{%business_gallery}}', ['created_by']);
        $this->createIndex('updated_by', '{{%business_gallery}}', ['updated_by']);
    }

    public function safeDown()
    {
        $this->dropTable('{{%business_gallery}}');
    }
}
