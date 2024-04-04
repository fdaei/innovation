<?php

use yii\db\Migration;

class m221130_120354_update_table_ince_career_apply extends Migration
{
    public function safeUp()
    {
        $this->dropColumn('{{%career_apply}}', 'created_by');
        $this->alterColumn('{{%career_apply}}', 'cv_file', $this->string(128));
        $this->alterColumn('{{%career_apply}}', 'status', $this->tinyInteger()->notNull());
    }

    public function safeDown()
    {
        $this->addColumn('{{%career_apply}}', 'created_by', $this->integer()->unsigned()->notNull());
        $this->alterColumn('{{%career_apply}}', 'cv_file', $this->string(128)->notNull());
        $this->alterColumn('{{%career_apply}}', 'status', $this->tinyInteger()->notNull()->defaultValue('1'));
    }
}