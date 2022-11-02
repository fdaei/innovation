<?php

use yii\db\Migration;

/**
 * Class m221102_055748_Business
 */
class m221102_055748_Business extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('business', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer()->notNull(),
            'city_id' => $this->integer()->notNull(),
            'title' => $this->string(),
            'logo' => $this->string(),
            'wallpaper' => $this->string(),
            'title' => $this->string(),
            'short_description' => $this->text(),
            'success_story' => $this->text(),
            'status' => $this->boolval(),
            'created_at'=>$this->integer(),
            'created_by'=>$this->integer()->notNull(),
            'updated_at'=>$this->integer(),
            'updated_by'=>$this->integer()->NULL(),
            'deleted_at'=>$this->integer(),
        ]);
        // creates index for column `user_id`
        $this->createIndex(
            'idx-business-user_id',
            'business',
            'user_id'
        );

        // add foreign key for table `user`
        $this->addForeignKey(
            'fk-business-user_id',
            'business',
            'user_id',
            'user',
            'id',
            'CASCADE'
        );
        // creates index for column `city_id`
        $this->createIndex(
        'idx-business-city_id',
        'business',
        'city_id'
        );
        
        // add foreign key for table `city_id`
        $this->addForeignKey(
        'fk-business-city_id',
        'business',
        'city_id',
        'city',
        'id',
        'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m221102_055748_Business cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m221102_055748_Business cannot be reverted.\n";

        return false;
    }
    */
}
