<?php

use yii\db\Migration;

/**
 * Class m230720_051312_create_table_mentor_category
 */
class m230720_051312_create_table_mentor_category extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable(
            '{{%mentor_category}}',
            [
                'id' => $this->primaryKey()->unsigned(),
                'title' => $this->string()->notNull(),
                'brief_description' => $this->string(),
                'picture' => $this->string(),
                'status' => $this->tinyInteger()->notNull()->defaultValue('1'),
                'updated_by' => $this->integer()->unsigned(),
                'updated_at' => $this->integer()->unsigned(),
                'created_at' => $this->integer()->unsigned()->notNull(),
                'deleted_at' => $this->integer()->unsigned()->notNull()->defaultValue('0'),
                'created_by' => $this->integer()->unsigned()->notNull(),
            ],
            $tableOptions
        );

        $this->createIndex('created_by', '{{%mentor_category}}', ['created_by']);
        $this->createIndex('updated_by', '{{%mentor_category}}', ['updated_by']);

        $this->addForeignKey(
            'mentor_category_user_ibfk_1',
            '{{%mentor_category}}',
            ['created_by'],
            '{{%user}}',
            ['id'],
            'RESTRICT',
            'RESTRICT'
        );
        $this->addForeignKey(
            'mentor_category_user_ibfk_2',
            '{{%mentor_category}}',
            ['updated_by'],
            '{{%user}}',
            ['id'],
            'RESTRICT',
            'RESTRICT'
        );
    }

    public function safeDown()
    {
        $this->dropTable('{{%mentor_category}}');
    }
}
