<?php

use yii\db\Migration;

class m221214_053823_update_table_ince_business_member extends Migration
{
    public function safeUp()
    {
        $this->alterColumn('{{%business_member}}', 'status', $this->integer()->defaultValue('1'));
    }

    public function safeDown()
    {
        $this->alterColumn('{{%business_member}}', 'status', $this->integer()->notNull());
    }
}
