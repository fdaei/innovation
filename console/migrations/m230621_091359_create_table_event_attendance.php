<?php

use yii\db\Migration;

/**
 * Class m230621_091359_create_table_event_attendance
 */
class m230621_091359_create_table_event_attendance extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable(
            '{{%event_attendance}}',
            [
                'id' => $this->primaryKey()->unsigned(),
                'event_id' => $this->integer()->unsigned()->notNull(),
                'user_id' => $this->integer()->unsigned(),
                'first_name' => $this->string(64)->notNull(),
                'last_name' => $this->string(128)->notNull(),
                'mobile' => $this->string(11)->notNull(),
                'email' => $this->string()->null(),
                'description' => $this->string(512),
                'status' => $this->tinyInteger()->defaultValue(2)->notNull(),
                'updated_by' => $this->integer()->unsigned(),
                'updated_at' => $this->integer()->unsigned()->notNull(),
                'created_at' => $this->integer()->unsigned()->notNull(),
                'created_by' => $this->integer()->unsigned(),
                'deleted_at' => $this->integer()->unsigned()->notNull()->defaultValue('0'),
            ],
            $tableOptions
        );

        $this->createIndex(
            'idx-unique-user-event-n1',
            '{{%event_attendance}}',
            ['event_id', 'user_id'],
            true
        );

        $this->createIndex(
            'idx-unique-user-event-n2',
            '{{%event_attendance}}',
            ['event_id', 'mobile'],
            true
        );

        $this->addForeignKey(
            'event_attendance_event_ibfk_1',
            '{{%event_attendance}}',
            ['event_id'],
            '{{%event}}',
            ['id'],
            'RESTRICT',
            'RESTRICT'
        );

        $this->addForeignKey(
            'event_attendance_user_ibfk_1',
            '{{%event_attendance}}',
            ['user_id'],
            '{{%user}}',
            ['id'],
            'RESTRICT',
            'RESTRICT'
        );

        $this->addForeignKey(
            'event_attendance_user_ibfk_2',
            '{{%event_attendance}}',
            ['created_by'],
            '{{%user}}',
            ['id'],
            'RESTRICT',
            'RESTRICT'
        );

        $this->addForeignKey(
            'event_attendance_user_ibfk_3',
            '{{%event_attendance}}',
            ['updated_by'],
            '{{%user}}',
            ['id'],
            'RESTRICT',
            'RESTRICT'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
       $this->dropTable('{{%event_attendance}}');
    }
}