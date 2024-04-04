<?php

use yii\db\Migration;

class m230207_091850_update_table_ince_notification extends Migration
{
    public function safeUp()
    {
        $this->addForeignKey(
            'ince_notification_ibfk_1',
            '{{%notification}}',
            ['created_by'],
            '{{%user}}',
            ['id'],
            'RESTRICT',
            'RESTRICT'
        );
        $this->addForeignKey(
            'ince_notification_ibfk_2',
            '{{%notification}}',
            ['updated_by'],
            '{{%user}}',
            ['id'],
            'RESTRICT',
            'RESTRICT'
        );
        $this->addForeignKey(
            'ince_notification_ibfk_3',
            '{{%notification}}',
            ['user_id'],
            '{{%user}}',
            ['id'],
            'RESTRICT',
            'RESTRICT'
        );
    }

    public function safeDown()
    {
        $this->dropForeignKey('ince_notification_ibfk_1', '{{%notification}}');
        $this->dropForeignKey('ince_notification_ibfk_2', '{{%notification}}');
        $this->dropForeignKey('ince_notification_ibfk_3', '{{%notification}}');
    }
}
