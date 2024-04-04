<?php

use yii\db\Migration;

class m221205_083727_update_table_ince_career_apply extends Migration
{
    public function safeUp()
    {
        $this->alterColumn('{{%career_apply}}', 'user_id', $this->integer()->unsigned());
        $this->alterColumn('{{%career_apply}}', 'status', $this->tinyInteger()->notNull()->defaultValue('1'));
        $this->alterColumn('{{%career_apply}}', 'updated_by', $this->integer()->unsigned());
    }

    public function safeDown()
    {
        $this->alterColumn('{{%career_apply}}', 'user_id', $this->integer()->unsigned()->notNull());
        $this->alterColumn('{{%career_apply}}', 'status', $this->tinyInteger()->notNull());
        $this->alterColumn('{{%career_apply}}', 'updated_by', $this->integer()->unsigned()->notNull());
    }
}
