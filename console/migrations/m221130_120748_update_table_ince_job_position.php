<?php

use yii\db\Migration;

class m221130_120748_update_table_ince_job_position extends Migration
{
    public function safeUp()
    {
        $this->dropColumn('{{%job_position}}', 'deleted_at');

        $this->addColumn('{{%job_position}}', 'immediate', $this->boolean()->notNull()->after('requirements'));
    }

    public function safeDown()
    {
        $this->dropColumn('{{%job_position}}', 'immediate');

        $this->addColumn('{{%job_position}}', 'deleted_at', $this->integer()->unsigned()->notNull()->defaultValue('0'));
    }
}
