<?php

use yii\db\Migration;

/**
 * Class m230404_070358_create_table_freelancer_category_list
 */
class m230404_070358_create_table_freelancer_category_list extends Migration
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
            '{{%freelancer_category_list}}',
            [
                'id' => $this->primaryKey()->unsigned(),
                'title' => $this->string()->notNull(),
                'brief_description' => $this->string()->null(),
                'picture' => $this->string()->null(),
                'status' => $this->integer()->notNull(),
                'model_class' => $this->string()->notNull(),
                'updated_by' => $this->integer()->unsigned(),
                'updated_at' => $this->integer()->unsigned(),
                'created_at' => $this->integer()->unsigned()->notNull(),
                'deleted_at' => $this->integer()->unsigned()->notNull()->defaultValue('0'),
            ],
            $tableOptions
        );

        $this->createIndex('updated_by', '{{%freelancer_category_list}}', ['updated_by']);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%freelancer_category_list}}');

    }

}
