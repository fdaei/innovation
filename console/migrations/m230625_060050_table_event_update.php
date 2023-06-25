<?php

use yii\db\Migration;

/**
 * Class m230625_060050_table_event_update
 */
class m230625_060050_table_event_update extends Migration
{
    public function safeUp()
    {

        $this->alterColumn('{{%event}}', 'status', $this->tinyInteger()->unsigned()->notNull()->defaultValue('1'));

    }

    public function safeDown()
    {

        $this->alterColumn('{{%event}}', 'status', $this->Integer()->notNull());

    }

}
