<?php

use yii\db\Migration;

class m221128_154058_create_table_ince_career_apply extends Migration
{
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable(
            '{{%career_apply}}',
            [
                'id' => $this->primaryKey()->unsigned(),
                'user_id' => $this->integer()->unsigned()->notNull(),
                'first_name' => $this->string(128)->notNull(),
                'last_name' => $this->string(128)->notNull(),
                'mobile' => $this->string(11)->notNull(),
                'email' => $this->string(256)->notNull(),
                'job_position_id' => $this->integer()->unsigned()->notNull(),
                'cv_file' => $this->string(128)->notNull(),
                'description' => $this->string(1024)->notNull(),
                'status' => $this->tinyInteger()->notNull()->defaultValue('1'),
                'created_at' => $this->integer()->unsigned()->notNull(),
                'created_by' => $this->integer()->unsigned()->notNull(),
                'updated_at' => $this->integer()->unsigned()->notNull(),
                'updated_by' => $this->integer()->unsigned()->notNull(),
                'deleted_at' => $this->integer()->unsigned()->notNull()->defaultValue('0'),
            ],
            $tableOptions
        );

        $this->createIndex('job_position_id', '{{%career_apply}}', ['job_position_id']);
        $this->createIndex('updated_by', '{{%career_apply}}', ['updated_by']);
        $this->createIndex('user_id', '{{%career_apply}}', ['user_id']);
    }

    public function safeDown()
    {
        $this->dropTable('{{%career_apply}}');
    }
}
