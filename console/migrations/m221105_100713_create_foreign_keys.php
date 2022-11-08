<?php

use yii\db\Migration;

class m221105_100713_create_foreign_keys extends Migration
{
    public function safeUp()
    {
        $this->addForeignKey(
            'business_ibfk_1',
            '{{%business}}',
            ['user_id'],
            '{{%user}}',
            ['id'],
            'RESTRICT',
            'RESTRICT'
        );
        $this->addForeignKey(
            'business_ibfk_2',
            '{{%business}}',
            ['created_by'],
            '{{%user}}',
            ['id'],
            'RESTRICT',
            'RESTRICT'
        );
        $this->addForeignKey(
            'business_ibfk_3',
            '{{%business}}',
            ['updated_by'],
            '{{%user}}',
            ['id'],
            'RESTRICT',
            'RESTRICT'
        );
        $this->addForeignKey(
            'business_timeline_ibfk_1',
            '{{%business_timeline}}',
            ['business_id'],
            '{{%business}}',
            ['id'],
            'RESTRICT',
            'RESTRICT'
        );
        $this->addForeignKey(
            'business_timeline_ibfk_2',
            '{{%business_timeline}}',
            ['created_by'],
            '{{%user}}',
            ['id'],
            'RESTRICT',
            'RESTRICT'
        );
        $this->addForeignKey(
            'business_timeline_ibfk_3',
            '{{%business_timeline}}',
            ['updated_by'],
            '{{%user}}',
            ['id'],
            'RESTRICT',
            'RESTRICT'
        );
        $this->addForeignKey(
            'business_gallery_ibfk_1',
            '{{%business_gallery}}',
            ['created_by'],
            '{{%user}}',
            ['id'],
            'RESTRICT',
            'RESTRICT'
        );
        $this->addForeignKey(
            'business_gallery_ibfk_2',
            '{{%business_gallery}}',
            ['updated_by'],
            '{{%user}}',
            ['id'],
            'RESTRICT',
            'RESTRICT'
        );
        $this->addForeignKey(
            'business_gallery_ibfk_3',
            '{{%business_gallery}}',
            ['business_id'],
            '{{%business}}',
            ['id'],
            'RESTRICT',
            'RESTRICT'
        );
        $this->addForeignKey(
            'city_ibfk_1',
            '{{%city}}',
            ['province_id'],
            '{{%province}}',
            ['id'],
            'RESTRICT',
            'RESTRICT'
        );
        $this->addForeignKey(
            'city_ibfk_2',
            '{{%city}}',
            ['created_by'],
            '{{%user}}',
            ['id'],
            'RESTRICT',
            'RESTRICT'
        );
        $this->addForeignKey(
            'city_ibfk_3',
            '{{%city}}',
            ['updated_by'],
            '{{%user}}',
            ['id'],
            'RESTRICT',
            'RESTRICT'
        );
        $this->addForeignKey(
            'profile_ibfk_1',
            '{{%profile}}',
            ['user_id'],
            '{{%user}}',
            ['id'],
            'RESTRICT',
            'RESTRICT'
        );
    }

    public function safeDown()
    {
        $this->dropForeignKey('business_gallery_ibfk_3', '{{%business_gallery}}');
        $this->dropForeignKey('business_gallery_ibfk_2', '{{%business_gallery}}');
        $this->dropForeignKey('business_gallery_ibfk_1', '{{%business_gallery}}');
        $this->dropForeignKey('business_timeline_ibfk_3', '{{%business_timeline}}');
        $this->dropForeignKey('business_timeline_ibfk_2', '{{%business_timeline}}');
        $this->dropForeignKey('business_timeline_ibfk_1', '{{%business_timeline}}');
        $this->dropForeignKey('business_ibfk_3', '{{%business}}');
        $this->dropForeignKey('business_ibfk_2', '{{%business}}');
        $this->dropForeignKey('business_ibfk_1', '{{%business}}');
        $this->dropForeignKey('profile_ibfk_1', '{{%profile}}');
        $this->dropForeignKey('city_ibfk_3', '{{%city}}');
        $this->dropForeignKey('city_ibfk_2', '{{%city}}');
        $this->dropForeignKey('city_ibfk_1', '{{%city}}');
    }
}