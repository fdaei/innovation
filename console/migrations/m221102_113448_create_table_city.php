<?php

use yii\db\Migration;

class m221102_113448_create_table_city extends Migration
{
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable(
            '{{%city}}',
            [
                'id' => $this->primaryKey()->unsigned(),
                'province_id' => $this->integer()->unsigned()->notNull(),
                'name' => $this->string(128)->notNull(),
                'latitude' => $this->float()->notNull(),
                'longitude' => $this->float()->notNull(),
                'status' => $this->tinyInteger()->unsigned()->notNull(),
                'created_at' => $this->integer()->unsigned()->notNull(),
                'created_by' => $this->integer()->unsigned()->notNull(),
                'updated_at' => $this->integer()->unsigned()->notNull(),
                'updated_by' => $this->integer()->unsigned()->notNull(),
                'deleted_at' => $this->integer()->unsigned()->defaultValue(0),
            ],
            $tableOptions
        );

        $this->createIndex('created_by', '{{%city}}', ['created_by']);
        $this->createIndex('province_id', '{{%city}}', ['province_id']);
        $this->createIndex('updated_by', '{{%city}}', ['updated_by']);
    }

    public function safeDown()
    {
        $this->dropTable('{{%city}}');
    }
}