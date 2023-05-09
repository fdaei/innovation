<?php

use yii\db\Migration;

/**
 * Class m230509_220928_change_image_column_to_null_table_business_member
 */
class m230509_220928_change_image_column_to_null_table_business_member extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->alterColumn('{{%business_member}}', 'image', $this->string()->null());

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m230509_220928_change_image_column_to_null_table_business_member cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m230509_220928_change_image_column_to_null_table_business_member cannot be reverted.\n";

        return false;
    }
    */
}
