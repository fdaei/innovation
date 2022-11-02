<?php

use yii\db\Migration;

class m221102_082955_create_foreign_keys extends Migration
{
    public function safeUp()
    {
        $this->addForeignKey(
            'business_ibfk_1',
            '{{%business}}',
            ['user_id'],
            '{{%user}}',
            ['id'],
            'CASCADE',
            'CASCADE'
        );
        $this->addForeignKey(
            'business_ibfk_2',
            '{{%business}}',
            ['created_by'],
            '{{%user}}',
            ['id'],
            'CASCADE',
            'CASCADE'
        );
        $this->addForeignKey(
            'business_ibfk_3',
            '{{%business}}',
            ['updated_by'],
            '{{%user}}',
            ['id'],
            'CASCADE',
            'CASCADE'
        );
        $this->addForeignKey(
            'business_timeline_ibfk_1',
            '{{%business_timeline}}',
            ['business_id'],
            '{{%business}}',
            ['id'],
            'CASCADE',
            'CASCADE'
        );
        $this->addForeignKey(
            'business_timeline_ibfk_2',
            '{{%business_timeline}}',
            ['created_by'],
            '{{%user}}',
            ['id'],
            'CASCADE',
            'CASCADE'
        );
        $this->addForeignKey(
            'business_timeline_ibfk_3',
            '{{%business_timeline}}',
            ['updated_by'],
            '{{%user}}',
            ['id'],
            'CASCADE',
            'CASCADE'
        );
        $this->addForeignKey(
            'business_stat_ibfk_1',
            '{{%business_stat}}',
            ['business_id'],
            '{{%business}}',
            ['id'],
            'CASCADE',
            'CASCADE'
        );
        $this->addForeignKey(
            'business_stat_ibfk_2',
            '{{%business_stat}}',
            ['created_by'],
            '{{%user}}',
            ['id'],
            'CASCADE',
            'CASCADE'
        );
        $this->addForeignKey(
            'business_stat_ibfk_3',
            '{{%business_stat}}',
            ['update_by'],
            '{{%user}}',
            ['id'],
            'CASCADE',
            'CASCADE'
        );
        $this->addForeignKey(
            'business_gallery_ibfk_1',
            '{{%business_gallery}}',
            ['business_id'],
            '{{%business}}',
            ['id'],
            'CASCADE',
            'CASCADE'
        );
        $this->addForeignKey(
            'business_gallery_ibfk_2',
            '{{%business_gallery}}',
            ['created_by'],
            '{{%user}}',
            ['id'],
            'CASCADE',
            'CASCADE'
        );
        $this->addForeignKey(
            'business_gallery_ibfk_3',
            '{{%business_gallery}}',
            ['updated_by'],
            '{{%user}}',
            ['id'],
            'CASCADE',
            'CASCADE'
        );
    }

    public function safeDown()
    {
        $this->dropForeignKey('business_gallery_ibfk_3', '{{%business_gallery}}');
        $this->dropForeignKey('business_gallery_ibfk_2', '{{%business_gallery}}');
        $this->dropForeignKey('business_gallery_ibfk_1', '{{%business_gallery}}');
        $this->dropForeignKey('business_stat_ibfk_3', '{{%business_stat}}');
        $this->dropForeignKey('business_stat_ibfk_2', '{{%business_stat}}');
        $this->dropForeignKey('business_stat_ibfk_1', '{{%business_stat}}');
        $this->dropForeignKey('business_timeline_ibfk_3', '{{%business_timeline}}');
        $this->dropForeignKey('business_timeline_ibfk_2', '{{%business_timeline}}');
        $this->dropForeignKey('business_timeline_ibfk_1', '{{%business_timeline}}');
        $this->dropForeignKey('business_ibfk_3', '{{%business}}');
        $this->dropForeignKey('business_ibfk_2', '{{%business}}');
        $this->dropForeignKey('business_ibfk_1', '{{%business}}');
    }
}
