<?php

use yii\db\Migration;

class m221214_053822_update_table_ince_business extends Migration
{
    public function safeUp()
    {

        $this->alterColumn('{{%business}}', 'status', $this->tinyInteger()->unsigned()->notNull()->defaultValue('1'));


    }

    public function safeDown()
    {
        $this->alterColumn('{{%business}}', 'status', $this->tinyInteger()->unsigned()->notNull());
    }
}
