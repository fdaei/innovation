<?php

use yii\db\Migration;

/**
 * Class m230404_084625_create_table_freelancer_categorys
 */
class m230404_084625_create_table_freelancer_categories extends Migration
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
            '{{%freelancer_categories}}',
            [
                'id' => $this->primaryKey()->unsigned(),
                'freelancer_id' => $this->integer()->notNull(),
                'categories_id' => $this->integer()->notNull(),
                'model_class' => $this->string()
            ],
            $tableOptions
        );

        $this->createIndex('freelancer_id', '{{%freelancer_categories}}', ['freelancer_id']);
        $this->createIndex('categories_id', '{{%freelancer_categories}}', ['categories_id']);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%freelancer_categories}}');

    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m230404_084625_create_table_freelancer_categorys cannot be reverted.\n";

        return false;
    }
    */
}
