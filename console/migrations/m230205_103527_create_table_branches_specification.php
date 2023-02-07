<?php

use yii\db\Migration;

class m230205_103527_create_table_branches_specification extends Migration
{
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable(
            '{{%branches_specification}}',
            [
                'id' => $this->primaryKey()->unsigned(),
                'branche_id' => $this->integer()->unsigned()->notNull(),
                'key' => $this->string()->notNull(),
                'value' => $this->text()->notNull(),
                'created_at' => $this->integer()->unsigned()->notNull(),
                'created_by' => $this->integer()->unsigned()->notNull(),
                'updated_at' => $this->integer()->unsigned()->notNull(),
                'updated_by' => $this->integer()->unsigned()->notNull(),
                'deleted_at' => $this->integer()->unsigned()->defaultValue('0'),
            ],
            $tableOptions
        );

        $this->createIndex('branche_id', '{{%branches_specification}}', ['branche_id']);

        $this->addForeignKey(
            'branches_specification_ibfk_1',
            '{{%branches_specification}}',
            ['branche_id'],
            '{{%branches}}',
            ['id'],
            'RESTRICT',
            'RESTRICT'
        );
    }

    public function safeDown()
    {
        $this->dropTable('{{%branches_specification}}');
    }
}
