<?php

use yii\db\Migration;

class m230130_074955_create_table_ince_activity extends Migration
{
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable(
            '{{%activity}}',
            [
                'id' => $this->primaryKey()->unsigned(),
                'title' => $this->string(256)->notNull(),
                'send_sms' => $this->tinyInteger()->unsigned()->notNull()->defaultValue('0'),
                'send_email' => $this->tinyInteger()->unsigned()->notNull()->defaultValue('0'),
                'status' => $this->tinyInteger()->unsigned()->notNull()->defaultValue('1'),
                'created_by' => $this->integer()->unsigned()->notNull(),
                'updated_by' => $this->integer()->unsigned()->notNull(),
                'created_at' => $this->integer()->unsigned()->notNull(),
                'updated_at' => $this->integer()->unsigned()->notNull(),
                'deleted_at' => $this->integer()->unsigned()->defaultValue('0'),
            ],
            $tableOptions
        );

        $this->createIndex('task_ibfk_1', '{{%activity}}', ['created_by']);
        $this->createIndex('task_ibfk_2', '{{%activity}}', ['updated_by']);
    }

    public function safeDown()
    {
        $this->dropTable('{{%activity}}');
    }
}
