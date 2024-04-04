<?php

use yii\db\Migration;

class m230507_102350_create_table_ince_business_member extends Migration
{
    public function safeUp()
    {
        if ($this->db->getTableSchema('{{%business_member}}', true) === null) {

            $tableOptions = null;
            if ($this->db->driverName === 'mysql') {
                $tableOptions = 'CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE=InnoDB';
            }

            $this->createTable(
                '{{%business_member}}',
                [
                    'first_name' => $this->string(64)->notNull(),
                    'last_name' => $this->string(64)->notNull(),
                    'image' => $this->string(128)->notNull(),
                    'position' => $this->string(64)->notNull(),
                    'id' => $this->primaryKey()->unsigned(),
                    'business_id' => $this->integer()->unsigned()->notNull(),
                    'status' => $this->tinyInteger()->unsigned()->notNull()->defaultValue('1'),
                    'created_at' => $this->integer()->notNull(),
                    'created_by' => $this->integer()->unsigned()->notNull(),
                    'updated_at' => $this->integer()->notNull(),
                    'updated_by' => $this->integer()->unsigned()->notNull(),
                    'deleted_at' => $this->integer()->notNull()->defaultValue('0'),
                ],
                $tableOptions
            );

            $this->createIndex('business_id', '{{%business_member}}', ['business_id']);

            $this->addForeignKey(
                'ince_business_member_ibfk_1',
                '{{%business_member}}',
                ['business_id'],
                '{{%businesses}}',
                ['id'],
                'RESTRICT',
                'RESTRICT'
            );
        }
    }

    public function safeDown()
    {
        $this->dropTable('{{%business_member}}');
    }
}
