<?php

use yii\db\Migration;

/**
 * Class m230428_140651_create_table_businesses_investors
 */
class m230428_140651_create_table_businesses_investors extends Migration
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
            '{{%businesses_investors}}',
            [
                'id' => $this->primaryKey()->unsigned(),
                'businesses_id' => $this->integer()->unsigned()->notNull(),
                'picture' => $this->text()->null(),
                'title' => $this->string()->notNull(),
                'description' => $this->string()->notNull(),
            ],
            $tableOptions
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%businesses_investors}}');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m230428_140651_create_table_businesses_investors cannot be reverted.\n";

        return false;
    }
    */
}
