<?php

use yii\db\Migration;

class m221105_065353_create_table_ince_province extends Migration
{
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable(
            '{{%province}}',
            [
                'id' => $this->primaryKey()->unsigned(),
                'name' => $this->string()->notNull(),
                'center_id' => $this->integer()->unsigned()->notNull(),
                'status' => $this->integer()->notNull(),
                'created_at' => $this->integer()->notNull(),
                'created_by' => $this->integer()->unsigned()->notNull(),
                'updated_at' => $this->integer()->notNull(),
                'updated_by' => $this->integer()->unsigned()->notNull(),
                'deleted_at' => $this->integer()->Null(),
            ],
            $tableOptions
        );

        $this->createIndex('created_by', '{{%province}}', ['created_by']);
        $this->createIndex('updated_by', '{{%province}}', ['updated_by']);

        $this->addForeignKey(
            'ince_province_ibfk_1',
            '{{%province}}',
            ['created_by'],
            '{{%user}}',
            ['id'],
            'CASCADE',
            'CASCADE'
        );
        $this->addForeignKey(
            'ince_province_ibfk_2',
            '{{%province}}',
            ['updated_by'],
            '{{%user}}',
            ['id'],
            'CASCADE',
            'CASCADE'
        );
    }

    public function safeDown()
    {
        $this->dropTable('{{%province}}');
    }
}
