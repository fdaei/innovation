<?php

use yii\db\Migration;

class m221214_053825_update_table_ince_business_timeline extends Migration
{
    public function safeUp()
    {
        $this->alterColumn('{{%business_timeline}}', 'status', $this->tinyInteger()->unsigned()->notNull()->defaultValue('1'));
    }

    public function safeDown()
    {
        $this->alterColumn('{{%business_timeline}}', 'status', $this->tinyInteger()->unsigned()->notNull());
    }
}
