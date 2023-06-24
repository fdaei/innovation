<?php

use yii\db\Migration;

/**
 * Class m230621_081051_create_table_event_time
 */
class m230621_081051_create_table_event_time extends Migration
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
            '{{%event_time}}',
            [
                'id' => $this->primaryKey()->unsigned(),
                'event_id' => $this->integer()->notNull()->unsigned()->notNull(),
                'start_at' => $this->integer()->unsigned()->notNull(),
                'end_at' => $this->integer()->unsigned()->notNull(),
                'status' => $this->tinyInteger()->defaultValue(1)->notNull(),
                'updated_by' => $this->integer()->unsigned()->notNull(),
                'updated_at' => $this->integer()->unsigned()->notNull(),
                'created_at' => $this->integer()->unsigned()->notNull(),
                'created_by' => $this->integer()->unsigned()->notNull(),
                'deleted_at' => $this->integer()->unsigned()->notNull()->defaultValue('0'),
            ],
            $tableOptions
        );

        $this->addForeignKey(
            'event_time_event_ibfk_1',
            '{{%event_time}}',
            ['event_id'],
            '{{%event}}',
            ['id'],
            'CASCADE'
        );


    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%event_time}}');
    }
}