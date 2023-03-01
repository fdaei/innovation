<?php

use yii\db\Migration;

class m230130_074956_create_table_ince_activity_comment extends Migration
{
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable(
            '{{%activity_comment}}',
            [
                'id' => $this->primaryKey()->unsigned(),
                'activity_id' => $this->integer()->unsigned()->notNull(),
                'created_by' => $this->integer()->unsigned()->notNull(),
                'updated_by' => $this->integer()->unsigned()->notNull(),
                'comment' => $this->string(1500)->notNull(),
                'created_at' => $this->integer()->unsigned()->notNull(),
                'updated_at' => $this->integer()->unsigned()->notNull(),
                'deleted_at' => $this->integer()->unsigned()->defaultValue('0'),
            ],
            $tableOptions
        );

        $this->createIndex('business_stat_ibfk_1', '{{%activity_comment}}', ['created_by']);
        $this->createIndex('business_stat_ibfk_3', '{{%activity_comment}}', ['updated_by']);
//        $this->createIndex('task_comment_ibfk_2', '{{%activity_comment}}', ['activity']);
    }

    public function safeDown()
    {
        $this->dropTable('{{%activity_comment}}');
    }
}
