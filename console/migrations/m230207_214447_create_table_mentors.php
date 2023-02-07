<?php

use yii\db\Migration;

/**
 * Class m230207_214447_create_table_mentors
 */
class m230207_214447_create_table_mentors extends Migration
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
            '{{%mentors}}',
            [
                'user_id' => $this->primaryKey()->unsigned(),
                'name' => $this->string(),
                'telegram' => $this->string()->null(),
                'instagram' => $this->string()->null(),
                'whatsapp' => $this->string()->null(),
                'activity_field' => $this->string(),
                'profile_pic' => $this->string(),
                'activity_description' => $this->text(),
                'consulting_fee' => $this->float(),
                'consultation_face_to_face' => $this->boolean(),
                'consultation_online' => $this->boolean(),
                'services' => $this->json()->null(),
                'records' => $this->json()->null(),
                'status' => $this->tinyInteger()->unsigned()->notNull(),
                'updated_at' => $this->integer()->unsigned()->notNull(),
                'updated_by' => $this->integer()->unsigned()->notNull(),
                'created_by' => $this->integer()->unsigned()->notNull(),
                'created_at' => $this->integer()->unsigned()->notNull(),
                'deleted_at' => $this->integer()->unsigned()->defaultValue('0'),
            ],
            $tableOptions
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%mentors}}');
    }
    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m230207_214447_create_table_mentors cannot be reverted.\n";

        return false;
    }
    */
}
