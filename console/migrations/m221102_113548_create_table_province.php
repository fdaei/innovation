<?php

use yii\db\Migration;

class m221102_113548_create_table_province extends Migration
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
                'name' => $this->string(64)->notNull(),
                'center_id' => $this->integer()->unsigned()->null(),
                'status' => $this->tinyInteger()->unsigned()->defaultValue(1)->notNull(),
                'created_at' => $this->integer()->unsigned()->notNull(),
                'created_by' => $this->integer()->unsigned()->notNull(),
                'updated_at' => $this->integer()->unsigned()->notNull(),
                'updated_by' => $this->integer()->unsigned()->notNull(),
                'deleted_at' => $this->integer()->unsigned()->defaultValue(0),
            ],
            $tableOptions
        );

        $this->createIndex('created_by', '{{%province}}', ['created_by']);
        $this->createIndex('province_id', '{{%province}}', ['center_id']);
        $this->createIndex('updated_by', '{{%province}}', ['updated_by']);

        $this->addForeignKey(
            'province_ibfk_1',
            '{{%province}}',
            ['created_by'],
            '{{%user}}',
            ['id'],
            'RESTRICT',
            'RESTRICT'
        );

        $this->addForeignKey(
            'province_ibfk_2',
            '{{%province}}',
            ['updated_by'],
            '{{%user}}',
            ['id'],
            'RESTRICT',
            'RESTRICT'
        );

        $this->addForeignKey(
            'province_ibfk_3',
            '{{%province}}',
            ['center_id'],
            '{{%city}}',
            ['id'],
            'RESTRICT',
            'RESTRICT'
        );
    }

    public function safeDown()
    {
        $this->dropTable('{{%province}}');
    }
}