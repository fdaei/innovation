<?php

use yii\db\Migration;

/**
 * Class m230428_154007_create_table_hitech
 */
class m230428_154007_create_table_hitech extends Migration
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
            '{{%hitech}}',
            [
                'id' => $this->primaryKey()->unsigned(),
                'title' => $this->string(),
                'description' => $this->text(),
                'required_skills' => $this->json()->notNull(),
                'minimum_budget' => $this->float()->null(),
                'maximum_budget' => $this->float()->null(),
                'status' => $this->integer()->notNull(),
                'updated_by' => $this->integer()->unsigned(),
                'updated_at' => $this->integer()->unsigned(),
                'created_at' => $this->integer()->unsigned(),
                'created_by' => $this->integer()->unsigned(),
                'deleted_at' => $this->integer()->unsigned()->notNull()->defaultValue('0'),
            ],
            $tableOptions
        );

        $this->createIndex('created_by', '{{%hitech}}', ['created_by']);
        $this->createIndex('updated_by', '{{%hitech}}', ['updated_by']);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%hitech}}');

    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m230428_154007_create_table_hitech cannot be reverted.\n";

        return false;
    }
    */
}
