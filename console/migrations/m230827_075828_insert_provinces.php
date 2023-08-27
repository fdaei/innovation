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
            ['center_id', 'name','created_at','updated_at','created_by','updated_by'],
            [
                [1, 'آذربایجان شرقی', time(), time(), '1', '1'],
                [2, 'آذربایجان غربی', time(), time(), '1', '1'],
                [3, 'اردبیل', time(), time(), '1', '1'],
                [4, 'اصفهان', time(), time(), '1', '1'],
                [5, 'البرز', time(), time(), '1', '1'],
                [6, 'ایلام', time(), time(), '1', '1'],
                [7, 'بوشهر', time(), time(), '1', '1'],
                [8, 'تهران', time(), time(), '1', '1'],
                [9, 'چهارمحال و بختیاری', time(), time(), '1', '1'],
                [10, 'خراسان جنوبی', time(), time(), '1', '1'],
                [11, 'خراسان رضوی', time(), time(), '1', '1'],
                [12, 'خراسان شمالی', time(), time(), '1', '1'],
                [13, 'خوزستان', time(), time(), '1', '1'],
                [14, 'زنجان', time(), time(), '1', '1'],
                [15, 'سمنان', time(), time(), '1', '1'],
                [16, 'سیستان و بلوچستان', time(), time(), '1', '1'],
                [17, 'فارس', time(), time(), '1', '1'],
                [18, 'قزوین', time(), time(), '1', '1'],
                [19, 'قم', time(), time(), '1', '1'],
                [20, 'کردستان', time(), time(), '1', '1'],
                [21, 'کرمان', time(), time(), '1', '1'],
                [22, 'کرمانشاه', time(), time(), '1', '1'],
                [23, 'کهگیلویه و بویراحمد', time(), time(), '1', '1'],
                [24, 'گلستان', time(), time(), '1', '1'],
                [25, 'گیلان', time(), time(), '1', '1'],
                [26, 'لرستان', time(), time(), '1', '1'],
                [27, 'مازندران', time(), time(), '1', '1'],
                [28, 'مرکزی', time(), time(), '1', '1'],
                [29, 'هرمزگان', time(), time(), '1', '1'],
                [30, 'همدان', time(), time(), '1', '1'],
                [31, 'یزد', time(), time(), '1', '1'],
                [32, 'اراک', time(), time(), '1', '1'],
            ]
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->delete('{{%province}}');
    }


}
