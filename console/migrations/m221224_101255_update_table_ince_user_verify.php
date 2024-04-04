<?php

use yii\db\Migration;

class m221224_101255_update_table_ince_user_verify extends Migration
{
    public function safeUp()
    {

        $this->alterColumn('{{%user_verify}}', 'code', $this->string()->notNull());
        $this->createIndex('code', '{{%user_verify}}', ['code']);

    }

    public function safeDown()
    {
        $this->dropIndex('code', '{{%user_verify}}');
        $this->alterColumn('{{%user_verify}}', 'code', $this->tinyInteger()->unsigned()->notNull());
    }
}
