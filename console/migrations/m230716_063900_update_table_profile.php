<?php

use yii\db\Migration;

/**
 * Class m230716_063900_update_table_profile
 */
class m230716_063900_update_table_profile extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->dropColumn('{{%profile}}','name');
        $this->addColumn('{{%profile}}','first_name',$this->string(64));
        $this->addColumn('{{%profile}}','last_name',$this->string(64));

        $this->addForeignKey(
            'profile_ibfk_1',
            '{{%profile}}',
            ['user_id'],
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
        $this->addColumn('{{%profile}}','name',$this->string());
        $this->dropColumn('{{%profile}}','first_name');
        $this->dropColumn('{{%profile}}','last_name');
    }
}
