<?php

use yii\db\Migration;

class m230214_101621_create_table_event extends Migration
{
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable(
            '{{%event}}',
            [
                'id' => $this->primaryKey()->unsigned(),
                'title' => $this->string()->notNull(),
                'price' => $this->float()->notNull(),
                'price_before_discount' => $this->float()->notNull(),
                'description' => $this->text()->notNull(),
                'headlines' => $this->json()->notNull(),
                'event_times' => $this->json()->notNull(),
                'address' => $this->text()->notNull(),
                'longitude' => $this->float()->notNull(),
                'latitude' => $this->float()->notNull(),
                'sponsors' => $this->json()->notNull(),
                'updated_at' => $this->integer()->unsigned()->notNull(),
                'updated_by' => $this->integer()->unsigned()->notNull(),
                'created_at' => $this->integer()->unsigned()->notNull(),
                'created_by' => $this->integer()->unsigned()->notNull(),
                'deleted_at' => $this->integer()->unsigned()->notNull()->defaultValue('0'),
            ],
            $tableOptions
        );

        $this->createIndex('created_by', '{{%event}}', ['created_by']);
        $this->createIndex('updated_by', '{{%event}}', ['updated_by']);

        $this->addForeignKey(
            'event_ibfk_1',
            '{{%event}}',
            ['created_by'],
            '{{%user}}',
            ['id'],
            'RESTRICT',
            'RESTRICT'
        );
        $this->addForeignKey(
            'event_ibfk_2',
            '{{%event}}',
            ['updated_by'],
            '{{%user}}',
            ['id'],
            'RESTRICT',
            'RESTRICT'
        );
    }

    public function safeDown()
    {
        $this->dropTable('{{%event}}');
    }
}
