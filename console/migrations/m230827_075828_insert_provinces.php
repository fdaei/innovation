<?php

use yii\db\Migration;

/**
 * Class m230827_075828_insert_provinces
 */
class m230827_075828_insert_provinces extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->batchInsert(
            '{{%province}}',
            ['id','center_id', 'name','created_at','updated_at','created_by','updated_by'],
            [
                [1,null, 'آذربایجان شرقی', time(), time(), '1', '1'],
                [2,null, 'آذربایجان غربی', time(), time(), '1', '1'],
                [3,null, 'اردبیل', time(), time(), '1', '1'],
                [4,null, 'اصفهان', time(), time(), '1', '1'],
                [5,null, 'البرز', time(), time(), '1', '1'],
                [6,null, 'ایلام', time(), time(), '1', '1'],
                [7,null, 'بوشهر', time(), time(), '1', '1'],
                [8,null, 'تهران', time(), time(), '1', '1'],
                [9,null, 'چهارمحال و بختیاری', time(), time(), '1', '1'],
                [10,null, 'اراک', time(), time(), '1', '1'],
                [11,null, 'خراسان جنوبی', time(), time(), '1', '1'],
                [12,null, 'خراسان رضوی', time(), time(), '1', '1'],
                [13,null, 'خراسان شمالی', time(), time(), '1', '1'],
                [14,null, 'خوزستان', time(), time(), '1', '1'],
                [15,null, 'زنجان', time(), time(), '1', '1'],
                [16,null, 'سمنان', time(), time(), '1', '1'],
                [17,null, 'سیستان و بلوچستان', time(), time(), '1', '1'],
                [18,null, 'فارس', time(), time(), '1', '1'],
                [19,null, 'قزوین', time(), time(), '1', '1'],
                [20,null, 'قم', time(), time(), '1', '1'],
                [21,null, 'کردستان', time(), time(), '1', '1'],
                [22,null, 'کرمان', time(), time(), '1', '1'],
                [23,null, 'کرمانشاه', time(), time(), '1', '1'],
                [24,null, 'کهگیلویه و بویراحمد', time(), time(), '1', '1'],
                [25,null, 'گلستان', time(), time(), '1', '1'],
                [26,null, 'گیلان', time(), time(), '1', '1'],
                [27,null, 'لرستان', time(), time(), '1', '1'],
                [28,null, 'مازندران', time(), time(), '1', '1'],
                [29,null, 'مرکزی', time(), time(), '1', '1'],
                [30,null, 'هرمزگان', time(), time(), '1', '1'],
                [31,null, 'همدان', time(), time(), '1', '1'],
                [32,null, 'یزد', time(), time(), '1', '1'],
            ]
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
    }


}
