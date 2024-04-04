<?php

use yii\db\Migration;

class m230625_083858_create_table_ince_tags_assign extends Migration
{
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable(
            '{{%tags_assign}}',
            [
                'id' => $this->primaryKey()->unsigned(),
                'class' => $this->string(128)->notNull(),
                'item_id' => $this->integer()->notNull(),
                'tag_id' => $this->integer()->notNull(),
            ],
            $tableOptions
        );

        $this->createIndex('class', '{{%tags_assign}}', ['class']);
        $this->createIndex('item_tag', '{{%tags_assign}}', ['item_id', 'tag_id']);
        $this->createIndex('unique_tags_assign_row', '{{%tags_assign}}', ['class', 'item_id', 'tag_id'], true);
    }

    public function safeDown()
    {
        $this->dropTable('{{%tags_assign}}');
    }
}
