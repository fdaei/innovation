<?php

use yii\db\Migration;

class m230205_140949_create_table_ince_branches_gallery extends Migration
{
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable(
            '{{%branches_gallery}}',
            [
                'id' => $this->primaryKey()->unsigned(),
                'branche_id' => $this->integer()->unsigned()->notNull(),
                'image' => $this->string(228)->notNull(),
                'mobile_image' => $this->string(128)->notNull(),
                'tablet_image' => $this->string(128)->notNull(),
                'status' => $this->tinyInteger()->unsigned()->notNull(),
                'created_at' => $this->integer()->unsigned()->notNull(),
                'created_by' => $this->integer()->unsigned()->notNull(),
                'updated_at' => $this->integer()->unsigned()->notNull(),
                'updated_by' => $this->integer()->unsigned()->notNull(),
                'deleted_at' => $this->integer()->unsigned()->notNull()->defaultValue('0'),
            ],
            $tableOptions
        );

        $this->createIndex('branche_id', '{{%branches_gallery}}', ['branche_id']);
        $this->createIndex('created_by', '{{%branches_gallery}}', ['created_by']);
        $this->createIndex('updated_by', '{{%branches_gallery}}', ['updated_by']);

        $this->addForeignKey(
            'ince_branches_gallery_ibfk_1',
            '{{%branches_gallery}}',
            ['branche_id'],
            '{{%branches}}',
            ['id'],
            'RESTRICT',
            'RESTRICT'
        );
        $this->addForeignKey(
            'ince_branches_gallery_ibfk_2',
            '{{%branches_gallery}}',
            ['created_by'],
            '{{%user}}',
            ['id'],
            'RESTRICT',
            'RESTRICT'
        );
        $this->addForeignKey(
            'ince_branches_gallery_ibfk_3',
            '{{%branches_gallery}}',
            ['updated_by'],
            '{{%user}}',
            ['id'],
            'RESTRICT',
            'RESTRICT'
        );
    }

    public function safeDown()
    {
        $this->dropTable('{{%branches_gallery}}');
    }
}
