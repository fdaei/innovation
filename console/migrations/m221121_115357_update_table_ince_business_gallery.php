<?php

use yii\db\Migration;

class m221121_115357_update_table_ince_business_gallery extends Migration
{
    public function safeUp()
    {
        $this->addColumn('{{%business_gallery}}', 'mobile_image', $this->string(128)->notNull()->after('image'));
    }

    public function safeDown()
    {
        $this->dropColumn('{{%business_gallery}}', 'mobile_image');

    }
}
