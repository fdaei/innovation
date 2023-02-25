<?php

use yii\db\Migration;

class m230222_080518_create_table_mentors_advice_request extends Migration
{
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable(
            '{{%mentors_advice_request}}',
            [
                'id' => $this->primaryKey()->unsigned(),
                'user_id' => $this->integer()->unsigned()->notNull(),
                'mentor_id' => $this->integer()->unsigned()->notNull(),
                'description' => $this->text()->notNull(),
                'date_advice' => $this->string()->notNull(),
                'type' => $this->tinyInteger()->unsigned()->notNull(),
                'file' => $this->string()->notNull(),
                'status' => $this->integer()->unsigned()->notNull(),
                'deleted_at' => $this->integer()->unsigned()->notNull()->defaultValue('0'),
                'updated_by' => $this->integer()->unsigned()->notNull(),
                'updated_at' => $this->integer()->unsigned()->notNull(),
                'created_at' => $this->integer()->unsigned()->notNull(),
                'created_by' => $this->integer()->unsigned()->notNull(),
            ],
            $tableOptions
        );

        $this->createIndex('created_by', '{{%mentors_advice_request}}', ['created_by']);
        $this->createIndex('mentor_id', '{{%mentors_advice_request}}', ['mentor_id']);
        $this->createIndex('updated_by', '{{%mentors_advice_request}}', ['updated_by']);
        $this->createIndex('user_id', '{{%mentors_advice_request}}', ['user_id']);

        $this->addForeignKey(
            'mentors_advice_request_ibfk_1',
            '{{%mentors_advice_request}}',
            ['mentor_id'],
            '{{%mentor}}',
            ['id'],
            'RESTRICT',
            'RESTRICT'
        );
        $this->addForeignKey(
            'mentors_advice_request_ibfk_2',
            '{{%mentors_advice_request}}',
            ['user_id'],
            '{{%user}}',
            ['id'],
            'RESTRICT',
            'RESTRICT'
        );
        $this->addForeignKey(
            'mentors_advice_request_ibfk_3',
            '{{%mentors_advice_request}}',
            ['created_by'],
            '{{%user}}',
            ['id'],
            'RESTRICT',
            'RESTRICT'
        );
        $this->addForeignKey(
            'mentors_advice_request_ibfk_4',
            '{{%mentors_advice_request}}',
            ['updated_by'],
            '{{%user}}',
            ['id'],
            'RESTRICT',
            'RESTRICT'
        );
    }

    public function safeDown()
    {
        $this->dropTable('{{%mentors_advice_request}}');
    }
}
