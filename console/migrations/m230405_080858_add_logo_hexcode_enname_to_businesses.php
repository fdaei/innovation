<?php

use yii\db\Migration;

/**
 * Class m230405_080858_add_logo_hexcode_enname_to_businesses
 */
class m230405_080858_add_logo_hexcode_enname_to_businesses extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%businesses}}', 'logo', $this->string()->notNull()->after('description'));
        $this->addColumn('{{%businesses}}', 'business_color', $this->string()->notNull()->after('logo') );
        $this->addColumn('{{%businesses}}', 'business_en_name', $this->string()->notNull()->after('business_color') );

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m230405_080858_add_logo_hexcode_enname_to_businesses cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m230405_080858_add_logo_hexcode_enname_to_businesses cannot be reverted.\n";

        return false;
    }
    */
}
