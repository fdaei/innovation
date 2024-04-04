<?php

use yii\db\Migration;

class m230205_140300_update_table_ince_branches_specification extends Migration
{
    public function safeUp()
    {
        $this->addForeignKey(
            'ince_branches_specification_ibfk_1',
            '{{%branches_specification}}',
            ['created_by'],
            '{{%user}}',
            ['id'],
            'RESTRICT',
            'RESTRICT'
        );
        $this->addForeignKey(
            'ince_branches_specification_ibfk_2',
            '{{%branches_specification}}',
            ['updated_by'],
            '{{%user}}',
            ['id'],
            'RESTRICT',
            'RESTRICT'
        );
    }

    public function safeDown()
    {
        $this->dropForeignKey('ince_branches_specification_ibfk_1', '{{%branches_specification}}');
        $this->dropForeignKey('ince_branches_specification_ibfk_2', '{{%branches_specification}}');
    }
}
