<?php

use yii\db\Migration;

/**
 * Class m230427_120319_create_table_event_sponsors
 */
class m230427_120319_create_table_event_sponsors extends Migration
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
            '{{%event_sponsors}}',
            [
                'id' => $this->primaryKey()->unsigned(),
                'event_id' => $this->integer()->notNull(),
                'title' => $this->string()->notNull(),
                'description' => $this->text()->notNull(),
                'picture' => $this->string()->null(),
                'instagram' => $this->string()->null(),
                'telegram' => $this->string()->null(),
                'whatsapp' => $this->string()->null(),
            ],
            $tableOptions
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m230427_120319_create_table_event_sponsors cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m230427_120319_create_table_event_sponsors cannot be reverted.\n";

        return false;
    }
    */
}
