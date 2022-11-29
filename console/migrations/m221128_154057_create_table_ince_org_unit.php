<?php

use yii\db\Migration;

class m221128_154057_create_table_ince_org_unit extends Migration
{
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable(
            '{{%org_unit}}',
            [
                'id' => $this->primaryKey()->unsigned(),
                'title' => $this->string(128)->notNull(),
                'description' => $this->string(512)->notNull(),
                'status' => $this->tinyInteger()->notNull()->defaultValue('1'),
                'created_at' => $this->integer()->unsigned()->notNull(),
                'created_by' => $this->integer()->unsigned()->notNull(),
                'updated_at' => $this->integer()->unsigned()->notNull(),
                'updated_by' => $this->integer()->unsigned()->notNull(),
                'deleted_at' => $this->integer()->unsigned()->notNull()->defaultValue('0'),
            ],
            $tableOptions
        );

        $this->createIndex('created_by', '{{%org_unit}}', ['created_by']);
        $this->createIndex('updated_by', '{{%org_unit}}', ['updated_by']);
    }

    public function safeDown()
    {
        $this->dropTable('{{%org_unit}}');
    }
}
