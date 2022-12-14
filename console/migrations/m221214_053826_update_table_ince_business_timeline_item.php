<?php

use yii\db\Migration;

class m221214_053826_update_table_ince_business_timeline_item extends Migration
{
    public function safeUp()
    {
        $this->alterColumn('{{%business_timeline_item}}', 'status', $this->tinyInteger()->unsigned()->notNull()->defaultValue('1'));
    }

    public function safeDown()
    {
        $this->alterColumn('{{%business_timeline_item}}', 'status', $this->tinyInteger()->notNull());
    }
}
