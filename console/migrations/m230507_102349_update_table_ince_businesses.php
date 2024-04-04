<?php

use yii\db\Migration;

class m230507_102349_update_table_ince_businesses extends Migration
{
    public function safeUp()
    {
        $this->addColumn('{{%businesses}}', 'slug', $this->string(128)->after('name'));
        $this->addColumn('{{%businesses}}', 'success_story', $this->string(512)->after('description'));
        $this->addColumn('{{%businesses}}', 'wallpaper', $this->string(128)->after('pic_small2_mobile'));
        $this->addColumn('{{%businesses}}', 'mobile_wallpaper', $this->string(128)->after('wallpaper'));
        $this->addColumn('{{%businesses}}', 'tablet_wallpaper', $this->string(128)->after('mobile_wallpaper'));
        $this->addColumn('{{%businesses}}', 'short_description', $this->string(512)->after('tablet_wallpaper'));
        $this->addColumn('{{%businesses}}', 'investor_description', $this->string(512)->after('short_description'));
    }

    public function safeDown()
    {
        $this->dropColumn('{{%businesses}}', 'slug');
        $this->dropColumn('{{%businesses}}', 'success_story');
        $this->dropColumn('{{%businesses}}', 'wallpaper');
        $this->dropColumn('{{%businesses}}', 'mobile_wallpaper');
        $this->dropColumn('{{%businesses}}', 'tablet_wallpaper');
        $this->dropColumn('{{%businesses}}', 'short_description');
        $this->dropColumn('{{%businesses}}', 'investor_description');
    }
}