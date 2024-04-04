<?php

use yii\db\Migration;

class m230130_075529_create_table_ince_activity_user_assignment extends Migration
{
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable(
            '{{%activity_user_assignment}}',
            [
                'activity_id' => $this->integer()->unsigned()->notNull(),
                'user_id' => $this->integer()->unsigned()->notNull(),
            ],
            $tableOptions
        );

        $this->createIndex('activity_id', '{{%activity_user_assignment}}', ['activity_id']);
        $this->createIndex('user_id', '{{%activity_user_assignment}}', ['user_id']);

        $this->addForeignKey(
            'activity_user_assignment_ibfk_1',
            '{{%activity_user_assignment}}',
            ['activity_id'],
            '{{%activity}}',
            ['id'],
            'RESTRICT',
            'RESTRICT'
        );
        $this->addForeignKey(
            'activity_user_assignment_ibfk_2',
            '{{%activity_user_assignment}}',
            ['user_id'],
            '{{%user}}',
            ['id'],
            'RESTRICT',
            'RESTRICT'
        );
    }

    public function safeDown()
    {
        $this->dropTable('{{%activity_user_assignment}}');
    }
}
