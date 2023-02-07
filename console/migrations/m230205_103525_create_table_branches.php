<?php

use yii\db\Migration;

class m230205_103525_create_table_branches extends Migration
{
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable(
            '{{%branches}}',
            [
                'id' => $this->primaryKey()->unsigned(),
                'title' => $this->string()->notNull(),
                'address' => $this->text()->notNull(),
                'longitude' => $this->float()->notNull(),
                'latitude' => $this->float()->notNull(),
                'mobile' => $this->string(11)->notNull(),
                'phone' => $this->string(11)->notNull(),
                'desk_count' => $this->integer()->notNull(),
                'status' => $this->tinyInteger()->unsigned()->notNull(),
                'updated_at' => $this->integer()->unsigned()->notNull(),
                'updated_by' => $this->integer()->unsigned()->notNull(),
                'created_by' => $this->integer()->unsigned()->notNull(),
                'created_at' => $this->integer()->unsigned()->notNull(),
                'deleted_at' => $this->integer()->unsigned()->defaultValue('0'),
            ],
            $tableOptions
        );
    }

    public function safeDown()
    {
        $this->dropTable('{{%branches}}');
    }
}
