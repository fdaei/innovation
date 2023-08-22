<?php

use yii\db\Migration;

/**
 * Class m230821_054743_status_ince_mentor
 */
class m230821_054743_status_ince_mentors_advice_request extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->alterColumn('{{%mentors_advice_request}}', 'status', $this->tinyInteger()->defaultValue(1));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->alterColumn('{{%mentors_advice_request}}', 'status', $this->tinyInteger()->defaultValue(0));
    }
}
