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
                'user_id' => $this->integer()->unsigned()->notNull(),
                'name' => $this->string()->notNull(),
                'picture_mentor' => $this->string()->null(),
                'activity_field' => $this->string()->notNull(),
                'activity_description' => $this->text()->notNull(),
                'picture' => $this->string()->null(),
                'video' => $this->string()->null(),
                'instagram' => $this->string()->null(),
                'linkedin' => $this->string()->null(),
                'twitter' => $this->string()->null(),
                'whatsapp' => $this->string()->null(),
                'telegram' => $this->string()->null(),
                'resume_file' => $this->string()->null(),
                'status' => $this->tinyInteger()->notNull()->defaultValue('0'),
                'consultation_face_to_face_status' => $this->boolean()->defaultValue(0),
                'consultation_face_to_face_cost' => $this->float()->null(),
                'consultation_online_status' => $this->boolean()->defaultValue(0),
                'consultation_online_cost' => $this->boolean()->null(),
                'services' => $this->json(),
                'records' => $this->json(),
                'updated_by' => $this->integer()->unsigned()->null(),
                'created_at' => $this->integer()->unsigned()->notNull(),
                'created_by' => $this->integer()->unsigned()->null(),
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
