<?php

use yii\db\Migration;

class m221220_090139_create_table_ince_user_verify extends Migration
{
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable(
            '{{%user_verify}}',
            [
                'id' => $this->primaryKey()->unsigned(),
                'phone' => $this->string(12)->notNull(),
                'type' => $this->tinyInteger()->unsigned()->notNull()->defaultValue('1'),
                'is_verify' => $this->tinyInteger()->unsigned()->notNull()->defaultValue('0'),
                'created' => $this->integer()->unsigned()->notNull(),
                'ip' => $this->string(64)->notNull(),
                'code' => $this->tinyInteger()->unsigned()->notNull(),
                'fail' => $this->tinyInteger()->unsigned()->notNull()->defaultValue('0'),
            ],
            $tableOptions
        );

        $this->createIndex('phone', '{{%user_verify}}', ['phone', 'code']);
    }

    public function safeDown()
    {
        $this->dropTable('{{%user_verify}}');
    }
}