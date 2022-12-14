<?php

use yii\db\Migration;

class m221214_053821_update_table_ince_business_gallery extends Migration
{
    public function safeUp()
    {
        $this->alterColumn('{{%business_gallery}}', 'status', $this->tinyInteger()->unsigned()->notNull()->defaultValue('1'));
    }

    public function safeDown()
    {
        $this->alterColumn('{{%business_gallery}}', 'status', $this->tinyInteger()->unsigned()->notNull());
    }
}
