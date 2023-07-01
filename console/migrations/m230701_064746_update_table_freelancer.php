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
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->alterColumn('{{%freelancer}}','created_by',$this->integer()->unsigned());
        $this->alterColumn('{{%freelancer}}','created_at',$this->integer()->unsigned());
        $this->alterColumn('{{%freelancer}}','updated_by',$this->integer()->unsigned());
    }
}
