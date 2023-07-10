<?php

use yii\db\Migration;

/**
 * Class m230311_091420_create_table_freelancer
 */
class m230311_091420_create_table_freelancer extends Migration
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
            '{{%freelancer}}',
            [
                'id' => $this->primaryKey()->unsigned(),
                'header_picture_desktop' => $this->string(),
                'header_picture_mobile' => $this->string(),
                'freelancer_picture' => $this->string(),
                'freelancer_description' => $this->text(),
                'name' => $this->string()->notNull(),
                'sex' => $this->boolean(),
                'email' => $this->string()->notNull(),
                'mobile' => $this->string()->notNull(),
                'city' => $this->integer()->notNull(),
                'province' => $this->integer()->notNull(),
                'marital_status' => $this->boolean()->notNull(),
                'military_service_status' => $this->boolean()->notNull(),
                'activity_field' => $this->string()->notNull(),
                'experience' => $this->string()->notNull(),
                'experience_period' => $this->string()->notNull(),
                'skills' => $this->json()->notNull(),
                'record_job' => $this->json(),
                'record_educational' => $this->json(),
                'portfolio' => $this->json()->null(),
                'resume_file' => $this->string(),
                'description_user' => $this->text()->notNull(),
                'project_number' => $this->integer(),
                'status' => $this->integer()->notNull(),
                'updated_by' => $this->integer()->unsigned(),
                'updated_at' => $this->integer()->unsigned(),
                'created_at' => $this->integer()->unsigned(),
                'created_by' => $this->integer()->unsigned(),
                'deleted_at' => $this->integer()->unsigned()->notNull()->defaultValue('0'),
            ],
            $tableOptions
        );

        $this->createIndex('created_by', '{{%freelancer}}', ['created_by']);
        $this->createIndex('updated_by', '{{%freelancer}}', ['updated_by']);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%freelancer}}');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m230311_091420_create_table_freelancer cannot be reverted.\n";

        return false;
    }
    */
}
