<?php

use yii\db\Migration;

class m221128_154100_create_foreign_keys extends Migration
{
    public function safeUp()
    {
        $this->addForeignKey(
            'org_unit_ibfk_1',
            '{{%org_unit}}',
            ['created_by'],
            '{{%user}}',
            ['id'],
            'RESTRICT',
            'RESTRICT'
        );
        $this->addForeignKey(
            'org_unit_ibfk_2',
            '{{%org_unit}}',
            ['updated_by'],
            '{{%user}}',
            ['id'],
            'RESTRICT',
            'RESTRICT'
        );
        $this->addForeignKey(
            'career_apply_ibfk_1',
            '{{%career_apply}}',
            ['user_id'],
            '{{%user}}',
            ['id'],
            'RESTRICT',
            'RESTRICT'
        );
        $this->addForeignKey(
            'career_apply_ibfk_2',
            '{{%career_apply}}',
            ['updated_by'],
            '{{%user}}',
            ['id'],
            'RESTRICT',
            'RESTRICT'
        );
        $this->addForeignKey(
            'career_apply_ibfk_3',
            '{{%career_apply}}',
            ['job_position_id'],
            '{{%job_position}}',
            ['id'],
            'RESTRICT',
            'RESTRICT'
        );
        $this->addForeignKey(
            'job_position_ibfk_2',
            '{{%job_position}}',
            ['created_by'],
            '{{%user}}',
            ['id'],
            'RESTRICT',
            'RESTRICT'
        );
        $this->addForeignKey(
            'job_position_ibfk_3',
            '{{%job_position}}',
            ['updated_by'],
            '{{%user}}',
            ['id'],
            'RESTRICT',
            'RESTRICT'
        );
    }

    public function safeDown()
    {
        $this->dropForeignKey('job_position_ibfk_3', '{{%job_position}}');
        $this->dropForeignKey('job_position_ibfk_2', '{{%job_position}}');
        $this->dropForeignKey('career_apply_ibfk_3', '{{%career_apply}}');
        $this->dropForeignKey('career_apply_ibfk_2', '{{%career_apply}}');
        $this->dropForeignKey('career_apply_ibfk_1', '{{%career_apply}}');
        $this->dropForeignKey('org_unit_ibfk_2', '{{%org_unit}}');
        $this->dropForeignKey('org_unit_ibfk_1', '{{%org_unit}}');
    }
}
