<?php

use yii\db\Migration;

class m221119_093112_update_table_ince_business extends Migration
{
    public function safeUp()
    {
        $this->addColumn('{{%business}}', 'investor_description', $this->text()->after('short_description'));
    }

    public function safeDown()
    {
        $this->dropColumn('{{%business}}', 'investor_description');
    }
}