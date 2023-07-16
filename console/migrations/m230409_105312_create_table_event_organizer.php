<?php

use yii\db\Migration;

/**
 * Class m230409_105312_create_table_event_organizer
 */
class m230409_105312_create_table_event_organizer extends Migration
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
            '{{%event_organizer}}',
            [
                'id' => $this->primaryKey()->unsigned(),
                'organizer_name' => $this->string()->notNull(),
                'organizer_avatar' => $this->string()->null(),
                'organizer_picture' => $this->string()->null(),
                'organizer_title_brief' => $this->string()->notNull(),
                'organizer_instagram' => $this->string(),
                'organizer_telegram' => $this->string(),
                'organizer_linkedin' => $this->string(),
                'updated_at' => $this->integer()->unsigned()->notNull(),
                'updated_by' => $this->integer()->unsigned()->notNull(),
                'created_at' => $this->integer()->unsigned()->notNull(),
                'created_by' => $this->integer()->unsigned()->notNull(),
                'deleted_at' => $this->integer()->unsigned()->notNull()->defaultValue('0'),
            ],
            $tableOptions
        );

        $this->createIndex('created_by', '{{%event_organizer}}', ['created_by']);
        $this->createIndex('updated_by', '{{%event_organizer}}', ['updated_by']);

    }


    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%event_organizer}}');

    }

}
