<?php

use yii\db\Migration;

/**
 * Class m230720_051520_create_table_mentor_categories
 */
class m230720_051520_create_table_mentor_categories extends Migration
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
            '{{%mentor_categories}}',
            [
                'id' => $this->primaryKey()->unsigned(),
                'mentor_id' => $this->integer()->unsigned()->notNull(),
                'category_id' => $this->integer()->unsigned()->notNull(),
                'created_at' => $this->integer()->unsigned()->notNull(),
                'updated_at' => $this->integer()->unsigned(),
                'created_by' => $this->integer()->unsigned()->notNull(),
                'updated_by' => $this->integer()->unsigned()->notNull(),
                'status' => $this->tinyInteger()->notNull()->defaultValue('1'),
                'deleted_at' => $this->integer()->unsigned()->notNull()->defaultValue('0'),
            ],
            $tableOptions
        );

        $this->createIndex('category_id', '{{%mentor_categories}}', ['category_id']);
        $this->createIndex('mentor_id', '{{%mentor_categories}}', ['mentor_id']);

        $this->addForeignKey(
            'mentor_category_ibfk_1',
            '{{%mentor_categories}}',
            ['mentor_id'],
            '{{%freelancer}}',
            ['id'],
            'RESTRICT',
            'RESTRICT'
        );
        $this->addForeignKey(
            'freelancer_category_list_ibfk_1',
            '{{%mentor_categories}}',
            ['category_id'],
            '{{%freelancer_category_list}}',
            ['id'],
            'RESTRICT',
            'RESTRICT'
        );
        $this->addForeignKey(
            'mentor_categories_user_ibfk_1',
            '{{%mentor_categories}}',
            ['created_by'],
            '{{%user}}',
            ['id'],
            'RESTRICT',
            'RESTRICT'
        );
        $this->addForeignKey(
            'mentor_categories_ibfk_2',
            '{{%mentor_categories}}',
            ['updated_by'],
            '{{%user}}',
            ['id'],
            'RESTRICT',
            'RESTRICT'
        );
    }

    public function safeDown()
    {
        $this->dropTable('{{%mentor_categories}}');
    }
}
