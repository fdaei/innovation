<?php

use yii\db\Migration;

class m230221_095835_create_table_ince_mentor extends Migration
{
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable(
            '{{%mentor}}',
            [
                'id' => $this->primaryKey()->unsigned(),
                'name' => $this->string()->notNull(),
                'mobile' => $this->string(12)->notNull(),
                'picture' => $this->string()->notNull(),
                'resume' => $this->string()->notNull(),
                'video' => $this->string(),
                'instagram' => $this->string(),
                'linkedin' => $this->string(),
                'twitter' => $this->string(),
                'documents' => $this->text()->notNull(),
                'description' => $this->text()->notNull(),
                'job_records' => $this->json()->notNull(),
                'education_records' => $this->json()->notNull(),
                'status' => $this->tinyInteger()->notNull()->defaultValue('0'),
                'user_id' => $this->integer()->unsigned()->notNull(),
                'whatsapp' => $this->string(),
                'telegram' => $this->string(),
                'activity_field' => $this->string()->notNull(),
                'activity_description' => $this->text()->notNull(),
                'consulting_fee' => $this->float()->notNull(),
                'consultation_face_to_face' => $this->boolean()->notNull(),
                'consultation_online' => $this->boolean()->notNull(),
                'services' => $this->json()->notNull(),
                'records' => $this->json()->notNull(),
                'updated_by' => $this->integer()->unsigned()->notNull(),
                'created_at' => $this->integer()->unsigned()->notNull(),
                'created_by' => $this->integer()->unsigned()->notNull(),
                'updated_at' => $this->integer()->unsigned()->notNull(),
                'deleted_at' => $this->integer()->unsigned()->notNull()->defaultValue('0'),
            ],
            $tableOptions
        );
        $this->createIndex('created_by', '{{%mentor}}', ['created_by']);
        $this->createIndex('updated_by', '{{%mentor}}', ['updated_by']);
        $this->createIndex('user_id', '{{%mentor}}', ['user_id']);
        $this->addForeignKey(
            'ince_mentor_ibfk_1',
            '{{%mentor}}',
            ['created_by'],
            '{{%user}}',
            ['id'],
            'RESTRICT',
            'RESTRICT'
        );
        $this->addForeignKey(
            'ince_mentor_ibfk_2',
            '{{%mentor}}',
            ['updated_by'],
            '{{%user}}',
            ['id'],
            'RESTRICT',
            'RESTRICT'
        );
        $this->addForeignKey(
            'ince_mentor_ibfk_3',
            '{{%mentor}}',
            ['user_id'],
            '{{%user}}',
            ['id'],
            'RESTRICT',
            'RESTRICT'
        );
    }

    public function safeDown()
    {
        $this->dropTable('{{%mentor}}');
    }
}
