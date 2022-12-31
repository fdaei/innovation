<?php

use yii\db\Migration;

class m221228_130151_update_table_ince_user extends Migration
{
    public function safeUp()
    {
        $this->alterColumn('{{%user}}', 'password_hash', $this->string());
        $this->alterColumn('{{%user}}', 'email', $this->string());
    }

    public function safeDown()
    {
        $this->alterColumn('{{%user}}', 'password_hash', $this->string()->notNull());
        $this->alterColumn('{{%user}}', 'email', $this->string()->notNull());
    }
}
