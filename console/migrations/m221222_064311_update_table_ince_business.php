<?php

use yii\db\Migration;

class m221222_064311_update_table_ince_business extends Migration
{
    public function safeUp()
    {
        $this->addColumn('{{%business}}', 'tablet_wallpaper', $this->string(1000)->after('deleted_at'));


    }

    public function safeDown()
    {
        $this->dropColumn('{{%business}}', 'tablet_wallpaper');

    }
}
