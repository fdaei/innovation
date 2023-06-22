<?php

use yii\db\Migration;

class m230621_095609_create_table_ince_tag extends Migration
{
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable(
            '{{%tag}}',
            [
                'id' => $this->primaryKey()->unsigned(),
                'type' => $this->tinyInteger()->notNull(),
                'name' => $this->string()->notNull(),
                'frequency' => $this->integer()->notNull(),
                'status' => $this->tinyInteger()->notNull(),
                'color' => $this->string()->notNull(),
                'description' => $this->string()->notNull(),
                'created_at' => $this->integer()->unsigned()->notNull(),
                'created_by' => $this->integer()->unsigned()->notNull(),
                'updated_at' => $this->integer()->unsigned()->notNull(),
                'updated_by' => $this->integer()->unsigned()->notNull(),
                'deleted_at' => $this->integer()->unsigned()->notNull(),
            ],
            $tableOptions
        );
    }

    public function safeDown()
    {
        $this->dropTable('{{%tag}}');
    }
}
