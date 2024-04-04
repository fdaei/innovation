<?php

use yii\db\Migration;

class m230815_065131_update_table_ince_freelancer extends Migration
{
    public function safeUp()
    {
        $this->addColumn('ince_freelancer', 'accept_rules', $this->boolean()->defaultValue(false)->notNull());
    }

    public function safeDown()
    {
        $this->dropColumn('ince_freelancer', 'accept_rules');
    }
}
