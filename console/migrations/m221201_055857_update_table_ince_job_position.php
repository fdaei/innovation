<?php

use yii\db\Migration;

class m221201_055857_update_table_ince_job_position extends Migration
{
    public function safeUp()
    {
        $this->alterColumn('{{%job_position}}', 'immediate', $this->boolean()->notNull()->defaultValue('0'));
    }

    public function safeDown()
    {
        $this->alterColumn('{{%job_position}}', 'immediate', $this->boolean()->notNull()->after('requirements'));
    }
}