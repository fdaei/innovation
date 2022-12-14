<?php

use yii\db\Migration;

class m221214_053824_update_table_ince_business_stat extends Migration
{
    public function safeUp()
    {
        $this->alterColumn('{{%business_stat}}', 'status', $this->tinyInteger()->unsigned()->notNull()->defaultValue('1'));
    }

    public function safeDown()
    {
        $this->alterColumn('{{%business_stat}}', 'status', $this->tinyInteger()->unsigned()->notNull());
    }
}
