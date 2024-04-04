<?php

use yii\db\Migration;

/**
 * Class m230207_223404_create_table_businesses
 */
class m230207_223404_create_table_businesses extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable(
            '{{%businesses}}',
            [
                'id' => $this->primaryKey()->unsigned(),
                'picture_desktop' => $this->string()->null(),
                'picture_mobile' => $this->string()->null(),
                'name' => $this->string(),
                'business_logo' => $this->string(),
                'business_color' => $this->string(),
                'business_en_name' => $this->string(),
                'site_name' => $this->string(),
                'description_brief' => $this->string(),
                'description' => $this->text(),
                'website' => $this->string(),
                'telegram' => $this->string()->null(),
                'instagram' => $this->string()->null(),
                'whatsapp' => $this->string()->null(),
                'pic_main_desktop' => $this->string()->null(),
                'pic_main_mobile' => $this->string()->null(),
                'pic_small1_desktop' => $this->string()->null(),
                'pic_small1_mobile' => $this->string()->null(),
                'pic_small2_desktop' => $this->string()->null(),
                'pic_small2_mobile' => $this->string()->null(),
                'statistics' => $this->json(),
                'services' => $this->json(),
                'investors' => $this->json(),
                'status' => $this->tinyInteger()->unsigned()->notNull(),
                'updated_at' => $this->integer()->unsigned()->notNull(),
                'updated_by' => $this->integer()->unsigned()->notNull(),
                'created_by' => $this->integer()->unsigned()->notNull(),
                'created_at' => $this->integer()->unsigned()->notNull(),
                'deleted_at' => $this->integer()->unsigned()->defaultValue('0'),
            ],
            $tableOptions
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%businesses}}');
    }

}
