<?php

use yii\db\Migration;

class m230207_091718_create_table_ince_notification extends Migration
{
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable(
            '{{%notification}}',
            [
                'id' => $this->primaryKey()->unsigned(),
                'user_id' => $this->integer()->unsigned()->notNull(),
                'receiver' => $this->string()->notNull(),
                'type' => $this->tinyInteger()->unsigned()->notNull(),
                'text' => $this->text()->notNull(),
                'created_at' => $this->integer()->unsigned()->notNull(),
                'created_by' => $this->integer()->unsigned()->notNull(),
                'updated_at' => $this->integer()->unsigned()->notNull(),
                'updated_by' => $this->integer()->unsigned()->notNull(),
                'deleted_at' => $this->integer()->unsigned()->notNull()->defaultValue('0'),
                'response' => $this->integer(),
                'priority' => $this->integer()->notNull()->defaultValue('1'),
                'send_at' => $this->integer(),
                'status' => $this->tinyInteger()->unsigned()->notNull(),
            ],
            $tableOptions
        );
    }

    public function safeDown()
    {
        $this->dropTable('{{%notification}}');
    }
}
