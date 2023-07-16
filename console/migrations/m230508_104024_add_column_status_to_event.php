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
        $this->dropColumn('{{%event}}', 'status');
    }
}
