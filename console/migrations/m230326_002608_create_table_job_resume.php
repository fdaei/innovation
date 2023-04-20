<?php

use yii\db\Migration;

/**
 * Class m230326_002608_create_table_job_resume
 */
class m230326_002608_create_table_job_resume extends Migration
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
            '{{%job_resume}}',
            [
                'id' => $this->primaryKey()->unsigned(),
                'job_id' => $this->integer(),
                'name' => $this->string()->notNull(),
                'sex' => $this->boolean()->notNull(),
                'email' => $this->string()->notNull(),
                'mobile' => $this->string()->notNull(),
                'birthday' => $this->string()->notNull(),
                'province' => $this->integer()->notNull(),
                'marital_status' => $this->boolean()->notNull(),
                'military_service_status' => $this->boolean()->notNull(),
                'file_resume' => $this->string(),
                'description' => $this->text(),
                'status' => $this->integer()->notNull(),
                'updated_by' => $this->integer()->unsigned(),
                'updated_at' => $this->integer()->unsigned(),
                'created_at' => $this->integer()->unsigned(),
                'created_by' => $this->integer()->unsigned(),
                'deleted_at' => $this->integer()->unsigned()->notNull()->defaultValue('0'),
            ],
            $tableOptions
        );

        $this->createIndex('created_by', '{{%job_resume}}', ['created_by']);
        $this->createIndex('updated_by', '{{%job_resume}}', ['updated_by']);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m230326_002608_create_table_job_resume cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m230326_002608_create_table_job_resume cannot be reverted.\n";

        return false;
    }
    */
}
