<?php

use yii\db\Migration;

class m221214_053827_update_table_ince_city extends Migration
{
    public function safeUp()
    {

        $this->alterColumn('{{%city}}', 'status', $this->tinyInteger()->unsigned()->notNull()->defaultValue('1'));

    }

    public function safeDown()
    {

        $this->alterColumn('{{%city}}', 'status', $this->tinyInteger()->unsigned()->notNull());

    }
}
