<?php

use yii\db\Migration;

class m230207_120649_update_table_ince_notification extends Migration
{
    public function safeUp()
    {
        $this->alterColumn('{{%notification}}', 'status', $this->tinyInteger()->unsigned()->notNull()->defaultValue('0'));
    }

    public function safeDown()
    {
        $this->alterColumn('{{%notification}}', 'status', $this->tinyInteger()->unsigned()->notNull());
    }
}
