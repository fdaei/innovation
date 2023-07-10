<?php

use yii\db\Migration;

class m230507_113652_create_table_ince_business_gallery extends Migration
{
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable(
            '{{%business_gallery}}',
            [
                'id' => $this->primaryKey()->unsigned(),
                'business_id' => $this->integer()->unsigned()->notNull(),
                'image' => $this->string(128)->notNull(),
                'mobile_image' => $this->string(128)->notNull(),
                'tablet_image' => $this->string(128),
                'title' => $this->string(256)->notNull(),
                'description' => $this->text()->notNull(),
                'status' => $this->tinyInteger()->unsigned()->notNull()->defaultValue('1'),
                'created_at' => $this->integer()->unsigned()->notNull(),
                'created_by' => $this->integer()->unsigned()->notNull(),
                'updated_at' => $this->integer()->unsigned()->notNull(),
                'updated_by' => $this->integer()->unsigned()->notNull(),
                'deleted_at' => $this->integer()->unsigned()->defaultValue('0'),
            ],
            $tableOptions
        );

        $this->createIndex('business_id', '{{%business_gallery}}', ['business_id']);
        $this->createIndex('created_by', '{{%business_gallery}}', ['created_by']);
        $this->createIndex('updated_by', '{{%business_gallery}}', ['updated_by']);

        $this->addForeignKey(
            'business_gallery_ibfk_3',
            '{{%business_gallery}}',
            ['business_id'],
            '{{%businesses}}',
            ['id'],
            'RESTRICT',
            'RESTRICT'
        );
    }

    public function safeDown()
    {
        $this->dropTable('{{%business_gallery}}');
    }
}
