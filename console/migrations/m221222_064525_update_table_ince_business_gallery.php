<?php

use yii\db\Migration;

class m221222_064525_update_table_ince_business_gallery extends Migration
{
    public function safeUp()
    {
        $this->addColumn('{{%business_gallery}}', 'tablet_image', $this->string(128)->after('mobile_image'));
    }

    public function safeDown()
    {
        $this->dropColumn('{{%business_gallery}}', 'tablet_image');
    }
}
