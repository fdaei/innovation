<?php

use yii\db\Migration;

/**
 * Class m230508_104024_add_column_status_to_event
 */
class m230508_104024_add_column_status_to_event extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function up()
    {
        $this->addColumn('{{%event}}', 'status', $this->integer()->notNull());
    }


    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m230508_104024_add_column_status_to_event cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m230508_104024_add_column_status_to_event cannot be reverted.\n";

        return false;
    }
    */
}
