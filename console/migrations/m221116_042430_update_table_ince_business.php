<?php

use yii\db\Migration;

class m221116_042430_update_table_ince_business extends Migration
{
    public function safeUp()
    {
        $this->addColumn('{{%business}}', 'link', $this->string(256)->after('city_id'));
        $this->addColumn('{{%business}}', 'slug', $this->string(128)->notNull()->after('link'));

        $this->createIndex('slug', '{{%business}}', ['slug', 'deleted_at'], true);
    }

    public function safeDown()
    {
        $this->dropIndex('slug', '{{%business}}');

        $this->dropColumn('{{%business}}', 'link');
        $this->dropColumn('{{%business}}', 'slug');
    }
}