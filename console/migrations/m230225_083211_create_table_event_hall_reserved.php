<?php

use yii\db\Migration;

class m230225_083211_create_table_event_hall_reserved extends Migration
{
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable(
            '{{%event_hall_reserved}}',
            [
                'id' => $this->primaryKey(),
                'event_hall_id' => $this->integer()->unsigned()->notNull(),
                'timestamp_start' => $this->integer()->notNull(),
                'timestamp_end' => $this->integer()->notNull(),
                'created_at' => $this->integer()->unsigned()->notNull(),
                'created_by' => $this->integer()->unsigned()->notNull(),
                'updated_at' => $this->integer()->unsigned()->notNull(),
                'updated_by' => $this->integer()->unsigned()->notNull(),
                'deleted_at' => $this->integer()->unsigned()->notNull()->defaultValue('0'),
            ],
            $tableOptions
        );

        $this->createIndex('created_by', '{{%event_hall_reserved}}', ['created_by']);
        $this->createIndex('event_hall_id', '{{%event_hall_reserved}}', ['event_hall_id']);
        $this->createIndex('updated_by', '{{%event_hall_reserved}}', ['updated_by']);
    }

    public function safeDown()
    {
        $this->dropTable('{{%event_hall_reserved}}');
    }
}
