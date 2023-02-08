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
                'name' => $this->string(),
                'website' => $this->string(),
                'telegram' => $this->string()->null(),
                'instagram' => $this->string()->null(),
                'whatsapp' => $this->string()->null(),
                'logo' => $this->string(),
                'description_brief' => $this->string(),
                'description' => $this->text(),
                'pic_main' => $this->string()->null(),
                'pic1' => $this->string()->null(),
                'pic2' => $this->string()->null(),
                'pic3' => $this->string()->null(),
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

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m230207_223404_create_table_businesses cannot be reverted.\n";

        return false;
    }
    */
}
