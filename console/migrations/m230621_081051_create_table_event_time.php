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
                'event_id' => $this->integer()->notNull()->unsigned(),
                'start_at' => $this->integer()->unsigned(),
                'end_at' => $this->integer()->unsigned(),
                'updated_by' => $this->integer()->unsigned(),
                'updated_at' => $this->integer()->unsigned(),
                'created_at' => $this->integer()->unsigned(),
                'created_by' => $this->integer()->unsigned(),
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
        echo "m230621_081051_create_table_event_time cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m230621_081051_create_table_event_time cannot be reverted.\n";

        return false;
    }
    */
}
