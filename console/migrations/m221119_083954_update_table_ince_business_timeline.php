<?php

use yii\db\Migration;

class m221119_083954_update_table_ince_business_timeline extends Migration
{
    public function safeUp()
    {
        $this->dropColumn('{{%business_timeline}}', 'description');

        $this->alterColumn('{{%business_timeline}}', 'id', $this->integer()->unsigned());
    }

    public function safeDown()
    {
        $this->addColumn('{{%business_timeline}}', 'description', $this->text()->notNull());

        $this->alterColumn('{{%business_timeline}}', 'id', $this->primaryKey());
    }
}