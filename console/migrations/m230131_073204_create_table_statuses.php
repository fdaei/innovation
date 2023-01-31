<?php

use yii\db\Migration;

class m230131_073204_create_table_statuses extends Migration
{
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable(
            '{{%statuses}}',
            [
                'id' => $this->primaryKey()->unsigned(),
                'title_fa' => $this->string(256)->notNull(),
                'title_en' => $this->string(256)->notNull(),
                'type' => $this->string()->notNull(),
                'created_by' => $this->integer()->unsigned()->notNull(),
                'updated_by' => $this->integer()->unsigned()->notNull(),
                'created_at' => $this->integer()->unsigned()->notNull(),
                'updated_at' => $this->integer()->unsigned()->notNull(),
                'deleted_at' => $this->integer()->unsigned()->defaultValue('0'),
            ],
            $tableOptions
        );
        $this->createIndex('statuses_ibfk_1', '{{%statuses}}', ['created_by']);
        $this->createIndex('statuses_ibfk_2', '{{%statuses}}', ['updated_by']);
        $this->addForeignKey(
            'statuses_ibfk_1',
            '{{%statuses}}',
            ['created_by'],
            '{{%user}}',
            ['id'],
            'RESTRICT',
            'RESTRICT'
        );
        $this->addForeignKey(
            'statuses_ibfk_2',
            '{{%statuses}}',
            ['updated_by'],
            '{{%user}}',
            ['id'],
            'RESTRICT',
            'RESTRICT'
        );
    }

    public function safeDown()
    {
        $this->dropTable('{{%statuses}}');
    }
}
