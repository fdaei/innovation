<?php

use yii\db\Migration;

class m230205_103528_create_foreign_keys extends Migration
{
    public function safeUp()
    {
        $this->addForeignKey(
            'branches_admin_ibfk_1',
            '{{%branches_admin}}',
            ['admin_id'],
            '{{%user}}',
            ['id'],
            'RESTRICT',
            'RESTRICT'
        );
    }

    public function safeDown()
    {
        $this->dropForeignKey('branches_admin_ibfk_1', '{{%branches_admin}}');
    }
}
