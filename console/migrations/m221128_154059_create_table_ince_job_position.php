<?php

use yii\db\Migration;

class m221128_154059_create_table_ince_job_position extends Migration
{
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable(
            '{{%job_position}}',
            [
                'id' => $this->primaryKey()->unsigned(),
                'title' => $this->string(128)->notNull(),
                'org_unit_id' => $this->integer()->unsigned()->notNull(),
                'description' => $this->string(1024)->notNull(),
                'requirements' => $this->string(1024)->notNull(),
                'status' => $this->tinyInteger()->notNull()->defaultValue('1'),
                'created_at' => $this->integer()->unsigned()->notNull(),
                'created_by' => $this->integer()->unsigned()->notNull(),
                'updated_at' => $this->integer()->unsigned()->notNull(),
                'updated_by' => $this->integer()->unsigned()->notNull(),
            ],
            $tableOptions
        );

        $this->createIndex('created_by', '{{%job_position}}', ['created_by']);
        $this->createIndex('org_unit_id', '{{%job_position}}', ['org_unit_id']);
        $this->createIndex('updated_by', '{{%job_position}}', ['updated_by']);

        $this->addForeignKey(
            'job_position_ibfk_1',
            '{{%job_position}}',
            ['org_unit_id'],
            '{{%org_unit}}',
            ['id'],
            'RESTRICT',
            'RESTRICT'
        );
    }

    public function safeDown()
    {
        $this->dropTable('{{%job_position}}');
    }
}
