<?php

use yii\db\Migration;

/**
 * Class m230531_110720_add_avapardaz_link_to_job_position_table
 */
class m230531_110720_add_avapardaz_link_to_job_position_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%job_position}}', 'avapardaz_link', $this->string()->after('immediate'));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%job_position}}', 'avapardaz_link');
    }
}
