<?php

use yii\db\Migration;

class m221119_054504_update_table_ince_business_timeline extends Migration
{
    public function safeUp()
    {
        $this->alterColumn('{{%business_timeline}}', 'description', $this->json()->notNull());
    }

    public function safeDown()
    {
        $this->alterColumn('{{%business_timeline}}', 'description', $this->text()->notNull());
    }
}
