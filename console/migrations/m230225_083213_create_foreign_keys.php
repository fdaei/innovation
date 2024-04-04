<?php

use yii\db\Migration;

class m230225_083213_create_foreign_keys extends Migration
{
    public function safeUp()
    {
        $this->addForeignKey(
            'ince_event_hall_ibfk_1',
            '{{%event_hall}}',
            ['branche_id'],
            '{{%branches}}',
            ['id'],
            'RESTRICT',
            'RESTRICT'
        );
        $this->addForeignKey(
            'ince_event_hall_ibfk_2',
            '{{%event_hall}}',
            ['created_by'],
            '{{%user}}',
            ['id'],
            'RESTRICT',
            'RESTRICT'
        );
        $this->addForeignKey(
            'ince_event_hall_ibfk_3',
            '{{%event_hall}}',
            ['updated_by'],
            '{{%user}}',
            ['id'],
            'RESTRICT',
            'RESTRICT'
        );
        $this->addForeignKey(
            'event_hall_reserved_ibfk_1',
            '{{%event_hall_reserved}}',
            ['created_by'],
            '{{%user}}',
            ['id'],
            'RESTRICT',
            'RESTRICT'
        );
        $this->addForeignKey(
            'event_hall_reserved_ibfk_2',
            '{{%event_hall_reserved}}',
            ['updated_by'],
            '{{%user}}',
            ['id'],
            'RESTRICT',
            'RESTRICT'
        );
        $this->addForeignKey(
            'event_hall_reserved_ibfk_3',
            '{{%event_hall_reserved}}',
            ['event_hall_id'],
            '{{%user}}',
            ['id'],
            'RESTRICT',
            'RESTRICT'
        );
        $this->addForeignKey(
            'event_hall_price_list_ibfk_1',
            '{{%event_hall_price_list}}',
            ['created_by'],
            '{{%user}}',
            ['id'],
            'RESTRICT',
            'RESTRICT'
        );
        $this->addForeignKey(
            'event_hall_price_list_ibfk_2',
            '{{%event_hall_price_list}}',
            ['updated_by'],
            '{{%user}}',
            ['id'],
            'RESTRICT',
            'RESTRICT'
        );
        $this->addForeignKey(
            'event_hall_price_list_ibfk_3',
            '{{%event_hall_price_list}}',
            ['event_hall_id'],
            '{{%event_hall}}',
            ['id'],
            'RESTRICT',
            'RESTRICT'
        );
    }

    public function safeDown()
    {
        $this->dropForeignKey('event_hall_price_list_ibfk_3', '{{%event_hall_price_list}}');
        $this->dropForeignKey('event_hall_price_list_ibfk_2', '{{%event_hall_price_list}}');
        $this->dropForeignKey('event_hall_price_list_ibfk_1', '{{%event_hall_price_list}}');
        $this->dropForeignKey('event_hall_reserved_ibfk_3', '{{%event_hall_reserved}}');
        $this->dropForeignKey('event_hall_reserved_ibfk_2', '{{%event_hall_reserved}}');
        $this->dropForeignKey('event_hall_reserved_ibfk_1', '{{%event_hall_reserved}}');
        $this->dropForeignKey('ince_event_hall_ibfk_3', '{{%event_hall}}');
        $this->dropForeignKey('ince_event_hall_ibfk_2', '{{%event_hall}}');
        $this->dropForeignKey('ince_event_hall_ibfk_1', '{{%event_hall}}');
    }
}
