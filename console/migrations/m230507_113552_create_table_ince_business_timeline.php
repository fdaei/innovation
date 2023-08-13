<?php

use yii\db\Migration;

class m230507_113552_create_table_ince_business_timeline extends Migration
{
    public function safeUp()
    {
        if ($this->db->getTableSchema('{{%business_timeline}}', true) === null) {
            $tableOptions = null;
            if ($this->db->driverName === 'mysql') {
                $tableOptions = 'CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE=InnoDB';
            }

            $this->createTable(
                '{{%business_timeline}}',
                [
                    'id' => $this->primaryKey()->unsigned(),
                    'business_id' => $this->integer()->unsigned()->notNull(),
                    'year' => $this->integer()->unsigned()->notNull(),
                    'status' => $this->tinyInteger()->unsigned()->notNull()->defaultValue('1'),
                    'created_at' => $this->integer()->unsigned()->notNull(),
                    'created_by' => $this->integer()->unsigned()->notNull(),
                    'updated_at' => $this->integer()->unsigned()->notNull(),
                    'updated_by' => $this->integer()->unsigned()->notNull(),
                    'deleted_at' => $this->integer()->unsigned()->notNull()->defaultValue('0'),
                ],
                $tableOptions
            );

            $this->createIndex('business_id', '{{%business_timeline}}', ['business_id']);
            $this->createIndex('created_by', '{{%business_timeline}}', ['created_by']);
            $this->createIndex('updated_by', '{{%business_timeline}}', ['updated_by']);
            $this->createIndex('year', '{{%business_timeline}}', ['year', 'business_id', 'deleted_at'], true);

            $this->addForeignKey(
                'business_timeline_ibfk_1',
                '{{%business_timeline}}',
                ['business_id'],
                '{{%businesses}}',
                ['id'],
                'RESTRICT',
                'RESTRICT'
            );
            $this->addForeignKey(
                'business_timeline_ibfk_2',
                '{{%business_timeline}}',
                ['created_by'],
                '{{%user}}',
                ['id'],
                'RESTRICT',
                'RESTRICT'
            );
            $this->addForeignKey(
                'business_timeline_ibfk_3',
                '{{%business_timeline}}',
                ['updated_by'],
                '{{%user}}',
                ['id'],
                'RESTRICT',
                'RESTRICT'
            );
        }
    }

    public function safeDown()
    {
        $this->dropTable('{{%business_timeline}}');
    }
}
