<?php

use yii\db\Migration;

class m230205_140126_update_table_ince_branches extends Migration
{
    public function safeUp()
    {
        $this->addColumn('{{%branches}}', 'description', $this->text()->notNull()->after('status'));
        $this->addColumn('{{%branches}}', 'image', $this->string(128)->notNull()->after('description'));


        $this->addForeignKey(
            'ince_branches_ibfk_1',
            '{{%branches}}',
            ['updated_by'],
            '{{%user}}',
            ['id'],
            'RESTRICT',
            'RESTRICT'
        );
        $this->addForeignKey(
            'ince_branches_ibfk_2',
            '{{%branches}}',
            ['created_by'],
            '{{%user}}',
            ['id'],
            'RESTRICT',
            'RESTRICT'
        );
    }

    public function safeDown()
    {
        $this->dropForeignKey('ince_branches_ibfk_1', '{{%branches}}');
        $this->dropForeignKey('ince_branches_ibfk_2', '{{%branches}}');
        $this->dropColumn('{{%branches}}', 'description');
        $this->dropColumn('{{%branches}}', 'image');

    }
}
