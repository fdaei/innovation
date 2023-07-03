<?php

use yii\db\Migration;

/**
 * Class m230701_064746_update_table_freelancer
 */
class m230701_064746_update_table_freelancer extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->alterColumn('{{%freelancer}}','created_at',$this->integer()->unsigned()->notNull());
        $this->alterColumn('{{%freelancer}}','created_by',$this->integer()->unsigned()->notNull());
        $this->alterColumn('{{%freelancer}}','updated_by',$this->integer()->unsigned()->notNull());

        $this->addForeignKey(
            'freelancer_user_ibfk_32',
            '{{%freelancer}}',
            ['created_by'],
            '{{%user}}',
            ['id'],
            'RESTRICT',
            'RESTRICT'
        );

        $this->addForeignKey(
            'freelancer_user_ibfk_2',
            '{{%freelancer}}',
            ['updated_by'],
            '{{%user}}',
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
        $this->alterColumn('{{%freelancer}}','created_by',$this->integer()->unsigned());
        $this->alterColumn('{{%freelancer}}','created_at',$this->integer()->unsigned());
        $this->alterColumn('{{%freelancer}}','updated_by',$this->integer()->unsigned());

        $this->dropForeignKey('freelancer_user_ibfk_1','{{%freelancer}}');
        $this->dropForeignKey('freelancer_user_ibfk_2','{{%freelancer}}');
    }
}
