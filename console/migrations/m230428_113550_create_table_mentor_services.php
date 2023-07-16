<?php

use yii\db\Migration;

/**
 * Class m230428_113550_create_table_mentor_services
 */
class m230428_113550_create_table_mentor_services extends Migration
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
            '{{%mentor_services}}',
            [
                'id' => $this->primaryKey()->unsigned(),
                'mentor_id' => $this->integer()->notNull(),
                'title' => $this->string()->notNull(),
                'picture' => $this->string()->null(),
                'description' => $this->text()->notNull(),
            ],
            $tableOptions
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%mentor_services}}');
    }

}
