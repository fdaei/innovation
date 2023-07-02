<?php

use yii\db\Migration;

/**
 * Class m230702_055247_create_table_freelancer_portfolio
 */
class m230702_055247_create_table_freelancer_portfolio extends Migration
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
            '{{%freelancer_portfolio}}',
            [
                'id' => $this->primaryKey()->unsigned(),
                'freelancer_id' => $this->integer()->unsigned()->notNull(),
                'title' => $this->string(128)->notNull(),
                'link' => $this->string(128),
                'description' => $this->string(512),
                'image' => $this->string(128),
                'status' => $this->tinyInteger()->defaultValue(1)->notNull(),
                'updated_by' => $this->integer()->unsigned(),
                'updated_at' => $this->integer()->unsigned()->notNull(),
                'created_at' => $this->integer()->unsigned()->notNull(),
                'created_by' => $this->integer()->unsigned()->notNull(),
                'deleted_at' => $this->integer()->unsigned()->notNull()->defaultValue('0'),
            ],
            $tableOptions
        );

        $this->addForeignKey(
            'freelancer_portfolio_ibfk_1',
            '{{%freelancer_portfolio}}',
            ['freelancer_id'],
            '{{%freelancer}}',
            ['id'],
            'RESTRICT',
            'RESTRICT'
        );


    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%freelancer_portfolio}}');

    }
}
