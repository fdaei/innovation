<?php

use yii\db\Migration;

/**
 * Class m230625_103528_update_ince_event
 */
class m230625_103528_update_ince_event extends Migration
{
    public function safeUp()
    {
        $this->dropColumn('{{%event}}', 'event_times');
    }

    public function safeDown()
    {
        $this->addColumn('{{%event}}', 'event_times', $this->json()->null());
    }
}