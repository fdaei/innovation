<?php

use yii\db\Migration;

class m230815_052120_update_table_ince_mentor extends Migration
{
    public function safeUp()
    {
        $this->alterColumn('{{%mentor}}', 'consultation_face_to_face_cost', $this->decimal(15, 0));
        $this->alterColumn('{{%mentor}}', 'consultation_online_cost', $this->decimal(15, 0));
    }

    public function safeDown()
    {
        $this->alterColumn('{{%mentor}}', 'consultation_face_to_face_cost', $this->float());
        $this->alterColumn('{{%mentor}}', 'consultation_online_cost', $this->boolean());
    }
}
