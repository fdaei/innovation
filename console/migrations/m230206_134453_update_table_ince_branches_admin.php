<?php

use yii\db\Migration;

class m230206_134453_update_table_ince_branches_admin extends Migration
{
    public function safeUp()
    {
        $this->addColumn('{{%branches_admin}}', 'id', $this->primaryKey()->unsigned()->first());
    }

    public function safeDown()
    {
        $this->dropColumn('{{%branches_admin}}', 'id');
    }
}
