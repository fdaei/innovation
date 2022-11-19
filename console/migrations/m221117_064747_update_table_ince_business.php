<?php

use yii\db\Migration;

class m221117_064747_update_table_ince_business extends Migration
{
    public function safeUp()
    {
        $this->dropIndex('business_ibfk_1', '{{%business}}');
        $this->dropIndex('business_ibfk_2', '{{%business}}');
        $this->dropIndex('business_ibfk_3', '{{%business}}');

        $this->addColumn('{{%business}}', 'id', $this->primaryKey()->unsigned()->first());
        $this->addColumn('{{%business}}', 'user_id', $this->integer()->unsigned()->notNull()->after('id'));
        $this->addColumn('{{%business}}', 'city_id', $this->integer()->notNull()->after('user_id'));
        $this->addColumn('{{%business}}', 'title', $this->string(256)->notNull()->after('city_id'));
        $this->addColumn('{{%business}}', 'link', $this->string(256)->notNull()->after('title'));
        $this->addColumn('{{%business}}', 'slug', $this->string(256)->notNull()->after('link'));
        $this->addColumn('{{%business}}', 'logo', $this->string(128)->after('slug'));
        $this->addColumn('{{%business}}', 'wallpaper', $this->string(128)->after('logo'));
        $this->addColumn('{{%business}}', 'short_description', $this->text()->notNull()->after('wallpaper'));
        $this->addColumn('{{%business}}', 'success_story', $this->text()->notNull()->after('short_description'));
        $this->addColumn('{{%business}}', 'investor_description', $this->text()->after('success_story'));
        $this->addColumn('{{%business}}', 'status', $this->tinyInteger()->unsigned()->notNull()->after('investor_description'));
        $this->addColumn('{{%business}}', 'created_at', $this->integer()->unsigned()->notNull()->after('status'));
        $this->addColumn('{{%business}}', 'created_by', $this->integer()->unsigned()->notNull()->after('created_at'));
        $this->addColumn('{{%business}}', 'updated_at', $this->integer()->unsigned()->notNull()->after('created_by'));
        $this->addColumn('{{%business}}', 'updated_by', $this->integer()->unsigned()->notNull()->after('updated_at'));
        $this->addColumn('{{%business}}', 'deleted_at', $this->integer()->unsigned()->defaultValue('0')->after('updated_by'));

        $this->createIndex('city_id', '{{%business}}', ['city_id']);
    }

    public function safeDown()
    {
        $this->dropIndex('city_id', '{{%business}}');

        $this->dropColumn('{{%business}}', 'id');
        $this->dropColumn('{{%business}}', 'user_id');
        $this->dropColumn('{{%business}}', 'city_id');
        $this->dropColumn('{{%business}}', 'title');
        $this->dropColumn('{{%business}}', 'link');
        $this->dropColumn('{{%business}}', 'slug');
        $this->dropColumn('{{%business}}', 'logo');
        $this->dropColumn('{{%business}}', 'wallpaper');
        $this->dropColumn('{{%business}}', 'short_description');
        $this->dropColumn('{{%business}}', 'success_story');
        $this->dropColumn('{{%business}}', 'investor_description');
        $this->dropColumn('{{%business}}', 'status');
        $this->dropColumn('{{%business}}', 'created_at');
        $this->dropColumn('{{%business}}', 'created_by');
        $this->dropColumn('{{%business}}', 'updated_at');
        $this->dropColumn('{{%business}}', 'updated_by');
        $this->dropColumn('{{%business}}', 'deleted_at');

        $this->createIndex('business_ibfk_1', '{{%business}}', ['user_id']);
        $this->createIndex('business_ibfk_2', '{{%business}}', ['created_by']);
        $this->createIndex('business_ibfk_3', '{{%business}}', ['updated_by']);
    }
}
