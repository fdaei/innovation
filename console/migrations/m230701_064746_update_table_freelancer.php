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
        $this->dropColumn('{{%freelancer}}', 'portfolio');

        $this->update('{{%freelancer}}', ['skills' => []]);
        $this->update('{{%freelancer}}', ['record_job' => []]);
        $this->update('{{%freelancer}}', ['record_educational' => []]);

        $this->addForeignKey(
            'freelancer_user_ibfk_1',
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
        $this->alterColumn('{{%freelancer}}','created_at',$this->integer()->unsigned());
        $this->addColumn('{{%freelancer}}','portfolio',$this->json()->null());

        $this->dropForeignKey('freelancer_user_ibfk_1','{{%freelancer}}');
        $this->dropForeignKey('freelancer_user_ibfk_2','{{%freelancer}}');
    }
}
