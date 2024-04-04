<?php

use yii\db\Migration;

class m230225_083210_create_table_ince_event_hall extends Migration
{
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable(
            '{{%event_hall}}',
            [
                'id' => $this->primaryKey()->unsigned(),
                'branche_id' => $this->integer()->unsigned()->notNull(),
                'name' => $this->string()->notNull(),
                'longitude' => $this->float()->unsigned()->notNull(),
                'latitude' => $this->float()->notNull(),
                'capacity' => $this->integer()->unsigned()->notNull(),
                'description' => $this->text(),
                'rules' => $this->text(),
                'specifications' => $this->json()->notNull(),
                'updated_by' => $this->integer()->unsigned()->notNull(),
                'updated_at' => $this->integer()->unsigned()->notNull(),
                'created_at' => $this->integer()->unsigned()->notNull(),
                'created_by' => $this->integer()->unsigned()->notNull(),
                'deleted_at' => $this->integer()->unsigned()->notNull()->defaultValue('0'),
            ],
            $tableOptions
        );

        $this->createIndex('branche_id', '{{%event_hall}}', ['branche_id']);
        $this->createIndex('created_by', '{{%event_hall}}', ['created_by']);
        $this->createIndex('updated_by', '{{%event_hall}}', ['updated_by']);
    }

    public function safeDown()
    {
        $this->dropTable('{{%event_hall}}');
    }
}
