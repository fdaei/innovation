<?php

use yii\db\Migration;

class m221102_113449_create_table_profile extends Migration
{
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable(
            '{{%profile}}',
            [
                'user_id' => $this->primaryKey()->unsigned(),
                'name' => $this->string(),
                'public_email' => $this->string(),
                'gravatar_email' => $this->string(),
                'gravatar_id' => $this->string(32),
                'location' => $this->string(),
                'website' => $this->string(),
                'bio' => $this->text(),
                'timezone' => $this->string(40),
            ],
            $tableOptions
        );
    }

    public function safeDown()
    {
        $this->dropTable('{{%profile}}');
    }
}
