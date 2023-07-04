<?php

use yii\db\Migration;

/**
 * Class m230703_113549_update_table_freelancer_categories
 */
class m230703_113549_update_table_freelancer_categories extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->alterColumn('{{%freelancer_categories}}','freelancer_id',$this->integer()->unsigned()->notNull());
        $this->alterColumn('{{%freelancer_categories}}','categories_id',$this->integer()->unsigned()->notNull());

        $this->addColumn('{{%freelancer_categories}}','created_at',$this->integer()->unsigned()->notNull());
        $this->addColumn('{{%freelancer_categories}}','updated_at',$this->integer()->unsigned());
        $this->addColumn('{{%freelancer_categories}}','created_by',$this->integer()->unsigned()->notNull());
        $this->addColumn('{{%freelancer_categories}}','updated_by',$this->integer()->unsigned()->notNull());
        $this->addColumn('{{%freelancer_categories}}','status',$this->tinyInteger()->defaultValue(1)->notNull());
        $this->addColumn('{{%freelancer_categories}}','deleted_at',$this->integer()->unsigned()->notNull()->defaultValue('0'));

        $this->dropColumn('{{%freelancer_categories}}','model_class');

        $this->addForeignKey(
            'freelancer_categories_ibfk_1',
            '{{%freelancer_categories}}',
            ['freelancer_id'],
            '{{%freelancer}}',
            ['id'],
            'RESTRICT',
            'RESTRICT'
        );

        $this->addForeignKey(
            'freelancer_categories_list_ibfk_1',
            '{{%freelancer_categories}}',
            ['categories_id'],
            '{{%freelancer_category_list}}',
            ['id'],
            'RESTRICT',
            'RESTRICT'
        );

        $this->addForeignKey(
            'freelancer_categories_user_ibfk_1',
            '{{%freelancer_categories}}',
            ['created_by'],
            '{{%user}}',
            ['id'],
            'RESTRICT',
            'RESTRICT'
        );

        $this->addForeignKey(
            'freelancer_categories_user_ibfk_2',
            '{{%freelancer_categories}}',
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
        $this->dropForeignKey('freelancer_categories_ibfk_1','{{%freelancer_categories}}');
        $this->dropForeignKey('freelancer_categories_list_ibfk_1','{{%freelancer_categories}}');
        $this->dropForeignKey('freelancer_categories_user_ibfk_1','{{%freelancer_categories}}');
        $this->dropForeignKey('freelancer_categories_user_ibfk_2','{{%freelancer_categories}}');

        $this->dropColumn('{{%freelancer_categories}}','created_by');
        $this->dropColumn('{{%freelancer_categories}}','updated_by');
        $this->dropColumn('{{%freelancer_categories}}','status');
        $this->dropColumn('{{%freelancer_categories}}','created_at');
        $this->dropColumn('{{%freelancer_categories}}','updated_at');
        $this->dropColumn('{{%freelancer_categories}}','deleted_at');

        $this->addColumn('{{%freelancer_categories}}','model_class',$this->string());


    }
}
