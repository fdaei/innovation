<?php

use yii\db\Migration;

class m230130_074957_create_foreign_keys extends Migration
{
    public function safeUp()
    {
        $this->addForeignKey(
            'task_ibfk_1',
            '{{%activity}}',
            ['created_by'],
            '{{%user}}',
            ['id'],
            'RESTRICT',
            'RESTRICT'
        );
        $this->addForeignKey(
            'task_ibfk_2',
            '{{%activity}}',
            ['updated_by'],
            '{{%user}}',
            ['id'],
            'RESTRICT',
            'RESTRICT'
        );
        $this->addForeignKey(
            'task_comment_ibfk_1',
            '{{%activity_comment}}',
            ['created_by'],
            '{{%user}}',
            ['id'],
            'RESTRICT',
            'RESTRICT'
        );
        $this->addForeignKey(
            'task_comment_ibfk_2',
            '{{%activity_comment}}',
            ['activity_id'],
            '{{%activity}}',
            ['id'],
            'CASCADE',
            'CASCADE'
        );
        $this->addForeignKey(
            'task_comment_ibfk_3',
            '{{%activity_comment}}',
            ['updated_by'],
            '{{%user}}',
            ['id'],
            'RESTRICT',
            'RESTRICT'
        );
    }

    public function safeDown()
    {
        $this->dropForeignKey('task_comment_ibfk_3', '{{%activity_comment}}');
        $this->dropForeignKey('task_comment_ibfk_2', '{{%activity_comment}}');
        $this->dropForeignKey('task_comment_ibfk_1', '{{%activity_comment}}');
        $this->dropForeignKey('task_ibfk_2', '{{%activity}}');
        $this->dropForeignKey('task_ibfk_1', '{{%activity}}');
    }
}
