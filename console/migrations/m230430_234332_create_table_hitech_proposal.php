<?php

use yii\db\Migration;

/**
 * Class m230430_234332_create_table_hitech_proposal
 */
class m230430_234332_create_table_hitech_proposal extends Migration
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
            '{{%hitech_proposal}}',
            [
                'id' => $this->primaryKey()->unsigned(),
                'hitech_id' => $this->integer()->notNull(),
                'name' => $this->string()->notNull(),
                'mobile' => $this->string()->notNull(),
                'description' => $this->text()->null(),
                'status' => $this->integer()->null(),
                'updated_at' => $this->integer()->unsigned(),
                'created_at' => $this->integer()->unsigned(),
                'deleted_at' => $this->integer()->unsigned()->notNull()->defaultValue('0'),
            ],
            $tableOptions
        );

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%hitech_proposal}}');
    }

}
