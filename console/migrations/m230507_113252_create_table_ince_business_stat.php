<?php

use yii\db\Migration;

class m230507_113252_create_table_ince_business_stat extends Migration
{
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable(
            '{{%business_stat}}',
            [
                'id' => $this->primaryKey(),
                'business_id' => $this->integer()->unsigned()->notNull(),
                'type' => $this->tinyInteger()->unsigned()->notNull()->defaultValue('1'),
                'title' => $this->string(256)->notNull(),
                'subtitle' => $this->string(256)->notNull(),
                'icon' => $this->string(128)->notNull(),
                'status' => $this->tinyInteger()->unsigned()->notNull()->defaultValue('1'),
                'created_at' => $this->integer()->unsigned()->notNull(),
                'created_by' => $this->integer()->unsigned()->notNull(),
                'updated_at' => $this->integer()->unsigned()->notNull(),
                'updated_by' => $this->integer()->unsigned()->notNull(),
                'deleted_at' => $this->integer()->unsigned()->defaultValue('0'),
            ],
            $tableOptions
        );

        $this->createIndex('business_id', '{{%business_stat}}', ['business_id']);
        $this->createIndex('business_stat_ibfk_2', '{{%business_stat}}', ['created_by']);

        $this->addForeignKey(
            'business_stat_ibfk_3',
            '{{%business_stat}}',
            ['business_id'],
            '{{%businesses}}',
            ['id'],
            'RESTRICT',
            'RESTRICT'
        );
    }

    public function safeDown()
    {
        $this->dropTable('{{%business_stat}}');
    }
}
