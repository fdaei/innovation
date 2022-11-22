<?php

use yii\db\Migration;

class m221121_115341_update_table_ince_business extends Migration
{
    public function safeUp()
    {
        $this->addColumn('{{%business}}', 'mobile_wallpaper', $this->string(2128)->after('wallpaper'));
    }

    public function safeDown()
    {
        $this->dropForeignKey('business_ibfk_1', '{{%business}}');
        $this->dropForeignKey('business_ibfk_2', '{{%business}}');
        $this->dropForeignKey('business_ibfk_3', '{{%business}}');

        $this->dropColumn('{{%business}}', 'link');
        $this->dropColumn('{{%business}}', 'slug');
        $this->dropColumn('{{%business}}', 'mobile_wallpaper');
        $this->dropColumn('{{%business}}', 'investor_description');
    }
}
