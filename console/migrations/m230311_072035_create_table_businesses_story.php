<?php

use yii\db\Migration;

/**
 * Class m230311_072035_create_table_businesses_story
 */
class m230311_072035_create_table_businesses_story extends Migration
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
            '{{%businesses_story}}',
            [
                'id' => $this->primaryKey()->unsigned(),
                'businesses_id' => $this->integer()->unsigned()->notNull(),
                'year' => $this->string()->notNull(),
                'title' => $this->string()->notNull(),
                'texts' => $this->json()->notNull(),
                'picture' => $this->text()->null(),
                'updated_by' => $this->integer()->unsigned()->notNull(),
                'updated_at' => $this->integer()->unsigned()->notNull(),
                'created_at' => $this->integer()->unsigned()->notNull(),
                'created_by' => $this->integer()->unsigned()->notNull(),
                'deleted_at' => $this->integer()->unsigned()->notNull()->defaultValue('0'),
            ],
            $tableOptions
        );

        $this->createIndex('businesses_id', '{{%businesses_story}}', ['businesses_id']);
        $this->createIndex('created_by', '{{%businesses_story}}', ['created_by']);
        $this->createIndex('updated_by', '{{%businesses_story}}', ['updated_by']);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%businesses_story}}');

    }
}