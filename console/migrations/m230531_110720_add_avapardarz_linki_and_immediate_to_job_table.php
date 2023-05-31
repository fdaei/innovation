<?php

use yii\db\Migration;

/**
 * Class m230531_110720_add_avapardarz_linki_and_immediate_to_job_table
 */
class m230531_110720_add_avapardarz_linki_and_immediate_to_job_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%job}}', 'immediate', $this->boolean()->defaultValue(false)->after('title'));
        $this->addColumn('{{%job}}', 'avapardarz_link', $this->string()->after('immediate'));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m230531_110720_add_avapardarz_linki_and_immediate_to_job_table cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m230531_110720_add_avapardarz_linki_and_immediate_to_job_table cannot be reverted.\n";

        return false;
    }
    */
}
