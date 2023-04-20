<?php

use yii\db\Migration;

/**
 * Class m230311_091426_create_table_contact_us
 */
class m230311_091426_create_table_contact_us extends Migration
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
            '{{%contact_us}}',
            [
                'id' => $this->primaryKey()->unsigned(),
                'name' => $this->string()->notNull(),
                'mobile' => $this->string()->notNull(),
                'title' => $this->string()->notNull(),
                'description_user' => $this->text(),
                'file' => $this->string(),
                'status' => $this->integer()->notNull(),
                'updated_by' => $this->integer()->unsigned(),
                'updated_at' => $this->integer()->unsigned(),
                'created_at' => $this->integer()->unsigned()->notNull(),
                'deleted_at' => $this->integer()->unsigned()->notNull()->defaultValue('0'),
            ],
            $tableOptions
        );

        $this->createIndex('updated_by', '{{%contact_us}}', ['updated_by']);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m230311_091426_create_table_contact_us cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m230311_091426_create_table_contact_us cannot be reverted.\n";

        return false;
    }
    */
}
