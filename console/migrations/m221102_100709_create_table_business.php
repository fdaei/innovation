<?php

use yii\db\Migration;

class m221102_100709_create_table_business extends Migration
{
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable(
            '{{%business}}',
            [
                'id' => $this->primaryKey(),
                'user_id' => $this->integer()->unsigned()->notNull(),
                'city_id' => $this->integer()->notNull(),
                'title' => $this->string()->notNull(),
                'logo' => $this->string()->notNull(),
                'wallpaper' => $this->string()->notNull(),
                'short_description' => $this->text()->notNull(),
                'success_story' => $this->text()->notNull(),
                'status' => $this->boolean()->notNull(),
                'created_at' => $this->integer()->unsigned()->notNull(),
                'created_by' => $this->integer()->unsigned()->notNull(),
                'updated_at' => $this->integer()->unsigned()->notNull(),
                'updated_by' => $this->integer()->unsigned()->notNull(),
                'deleted_at' => $this->integer()->unsigned()->notNull(),
            ],
            $tableOptions
        );

        $this->createIndex('city_id', '{{%business}}', ['city_id']);
        $this->createIndex('created_by', '{{%business}}', ['created_by']);
        $this->createIndex('updated_by', '{{%business}}', ['updated_by']);
        $this->createIndex('user_id', '{{%business}}', ['user_id']);
    }

    public function safeDown()
    {
        $this->dropTable('{{%business}}');
    }
}
