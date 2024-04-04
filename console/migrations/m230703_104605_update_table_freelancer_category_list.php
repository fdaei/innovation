<?php

use yii\db\Migration;

/**
 * Class m230703_104605_update_table_freelancer_category_list
 */
class m230703_104605_update_table_freelancer_category_list extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%freelancer_category_list}}','created_by',$this->integer()->unsigned()->notNull()->defaultValue(null));

        $this->alterColumn('{{%freelancer_category_list}}','updated_by',$this->integer()->unsigned());
        $this->alterColumn('{{%freelancer_category_list}}','status',$this->tinyInteger()->defaultValue(1)->notNull());

        $this->dropColumn('{{%freelancer_category_list}}','model_class');

        $this->addForeignKey(
            'freelancer_category_list_user_ibfk_1',
            '{{%freelancer_category_list}}',
            ['created_by'],
            '{{%user}}',
            ['id'],
            'RESTRICT',
            'RESTRICT'
        );

        $this->addForeignKey(
            'freelancer_category_list_user_ibfk_2',
            '{{%freelancer_category_list}}',
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

        $this->dropForeignKey('freelancer_category_list_user_ibfk_1','{{%freelancer_category_list}}');
        $this->dropForeignKey('freelancer_category_list_user_ibfk_2','{{%freelancer_category_list}}');

        $this->dropColumn('{{%freelancer_category_list}}','created_by');

        $this->alterColumn('{{%freelancer_category_list}}','updated_by',$this->integer()->unsigned());
        $this->alterColumn('{{%freelancer_category_list}}','status',$this->integer()->notNull());

        $this->addColumn('{{%freelancer_category_list}}','model_class',$this->string());

    }
}
