<?php

use yii\db\Migration;

class m230209_052130_update_table_ince_mentors extends Migration
{
    public function safeUp()
    {
        $this->addColumn('{{%mentors}}', 'id', $this->primaryKey()->unsigned()->first());
    }

    public function safeDown()
    {
        $this->dropColumn('{{%mentors}}', 'id');
    }
}
