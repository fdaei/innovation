<?php

use yii\db\Migration;

/**
 * Class m230325_234851_create_table_job
 */
class m230325_234851_create_table_job extends Migration
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
            '{{%job}}',
            [
                'id' => $this->primaryKey()->unsigned(),
                'business_id' => $this->integer(),
                'title' => $this->string(),
                'job_category' => $this->string(),
                'type_cooperation' => $this->string(),
                'time_cooperation' => $this->string()->notNull(),
                'location' => $this->string(),
                'description' => $this->text(),
                'required_skills' => $this->json()->notNull(),
                'status' => $this->integer()->notNull(),
                'updated_by' => $this->integer()->unsigned(),
                'updated_at' => $this->integer()->unsigned(),
                'created_at' => $this->integer()->unsigned(),
                'created_by' => $this->integer()->unsigned(),
                'deleted_at' => $this->integer()->unsigned()->notNull()->defaultValue('0'),
            ],
            $tableOptions
        );

        $this->createIndex('created_by', '{{%job}}', ['created_by']);
        $this->createIndex('updated_by', '{{%job}}', ['updated_by']);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m230325_234851_create_table_job cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m230325_234851_create_table_job cannot be reverted.\n";

        return false;
    }
    */
}
