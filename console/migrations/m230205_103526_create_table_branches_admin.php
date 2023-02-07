<?php

use yii\db\Migration;

class m230205_103526_create_table_branches_admin extends Migration
{
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable(
            '{{%branches_admin}}',
            [
                'branche_id' => $this->integer()->unsigned()->notNull(),
                'admin_id' => $this->integer()->unsigned()->notNull(),
            ],
            $tableOptions
        );

        $this->createIndex('admin_id', '{{%branches_admin}}', ['admin_id']);
        $this->createIndex('branche_id', '{{%branches_admin}}', ['branche_id']);

        $this->addForeignKey(
            'branches_admin_ibfk_2',
            '{{%branches_admin}}',
            ['branche_id'],
            '{{%branches}}',
            ['id'],
            'RESTRICT',
            'RESTRICT'
        );
    }

    public function safeDown()
    {
        $this->dropTable('{{%branches_admin}}');
    }
}
