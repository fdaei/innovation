<?php

use yii\db\Migration;

/**
 * Class m230625_103528_update_ince_event
 */
class m230625_103528_update_ince_event extends Migration
{
    public function safeUp()
    {
    }

    public function safeDown()
    {
        $this->alterColumn('{{%event}}', 'event_times', $this->json()->null());
    }
}
