<?php

use yii\db\Migration;

/**
 * Class m230827_075927_insert_cities
 */
class m230827_075927_insert_cities extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->batchInsert(
            '{{%city}}',
            ['province_id', 'name', 'latitude', 'longitude', 'created_at', 'updated_at', 'created_by', 'updated_by'],
            [
                [1, 'تبریز', '38.0809', '46.2919', time(), time(), '1', '1'],
                [2, 'ارومیه', '37.5528', '45.0761', time(), time(), '1', '1'],
                [3, 'اردبیل', '38.4853', '47.8911', time(), time(), '1', '1'],
                [4, 'اصفهان', '32.6546', '51.6680', time(), time(), '1', '1'],
                [5, 'کرج', '35.8140', '51.3974', time(), time(), '1', '1'],
                [6, 'ایلام', '33.2915', '46.6706', time(), time(), '1', '1'],
                [7, 'بوشهر', '28.9220', '50.8466', time(), time(), '1', '1'],
                [8, 'تهران', '35.6892', '51.3890', time(), time(), '1', '1'],
                [9, 'شهرکرد', '32.3256', '50.8649', time(), time(), '1', '1'],
                [10, 'بیرجند', '32.8649', '59.2260', time(), time(), '1', '1'],
                [11, 'خراسان رضوی', '36.2605', '59.6168', time(), time(), '1', '1'],
                [12, 'بجنورد', '37.4753', '57.3290', time(), time(), '1', '1'],
                [13, 'اهواز', '31.3156', '48.6695', time(), time(), '1', '1'],
                [14, 'زنجان', '36.6810', '48.4233', time(), time(), '1', '1'],
                [15, 'سمنان', '35.2254', '54.4342', time(), time(), '1', '1'],
                [16, 'زاهدان', '29.4963', '60.8629', time(), time(), '1', '1'],
                [17, 'شیراز', '29.5910', '52.5837', time(), time(), '1', '1'],
                [18, 'قزوین', '36.0881', '49.8547', time(), time(), '1', '1'],
                [19, 'قم', '34.6401', '50.8764', time(), time(), '1', '1'],
                [20, 'سنندج', '35.3213', '46.9865', time(), time(), '1', '1'],
                [21, 'کرمان', '30.2839', '57.0834', time(), time(), '1', '1'],
                [22, 'کرمانشاه', '34.3142', '47.0657', time(), time(), '1', '1'],
                [23, 'یاسوج', '30.6686', '51.5862', time(), time(), '1', '1'],
                [24, 'گرگان', '36.8439', '54.4432', time(), time(), '1', '1'],
                [25, 'رشت', '37.2800', '49.5832', time(), time(), '1', '1'],
                [26, 'خرم‌آباد', '33.4878', '48.3555', time(), time(), '1', '1'],
                [27, 'ساری', '36.5633', '53.0601', time(), time(), '1', '1'],
                [28, 'مرکزی', '34.6337', '50.9899', time(), time(), '1', '1'],
                [29, 'بندرعباس', '27.1865', '56.2808', time(), time(), '1', '1'],
                [30, 'همدان', '34.7992', '48.5146', time(), time(), '1', '1'],
                [31, 'یزد', '32.4279', '54.6512', time(), time(), '1', '1'],
                [32, 'مرکزی', '34.08', '49.70', time(), time(), '1', '1'],
            ]
        );
        $this->update('{{%province}}', ['center_id' => 1], ['id' => 1]);
        $this->update('{{%province}}', ['center_id' => 2], ['id' => 2]);
        $this->update('{{%province}}', ['center_id' => 3], ['id' => 3]);
        $this->update('{{%province}}', ['center_id' => 4], ['id' => 4]);
        $this->update('{{%province}}', ['center_id' => 5], ['id' => 5]);
        $this->update('{{%province}}', ['center_id' => 6], ['id' => 6]);
        $this->update('{{%province}}', ['center_id' => 7], ['id' => 7]);
        $this->update('{{%province}}', ['center_id' => 8], ['id' => 8]);
        $this->update('{{%province}}', ['center_id' => 9], ['id' => 9]);
        $this->update('{{%province}}', ['center_id' => 10], ['id' => 10]);
        $this->update('{{%province}}', ['center_id' => 11], ['id' => 11]);
        $this->update('{{%province}}', ['center_id' => 12], ['id' => 12]);
        $this->update('{{%province}}', ['center_id' => 13], ['id' => 13]);
        $this->update('{{%province}}', ['center_id' => 14], ['id' => 14]);
        $this->update('{{%province}}', ['center_id' => 15], ['id' => 15]);
        $this->update('{{%province}}', ['center_id' => 16], ['id' => 16]);
        $this->update('{{%province}}', ['center_id' => 17], ['id' => 17]);
        $this->update('{{%province}}', ['center_id' => 18], ['id' => 18]);
        $this->update('{{%province}}', ['center_id' => 19], ['id' => 19]);
        $this->update('{{%province}}', ['center_id' => 20], ['id' => 20]);
        $this->update('{{%province}}', ['center_id' => 21], ['id' => 21]);
        $this->update('{{%province}}', ['center_id' => 22], ['id' => 22]);
        $this->update('{{%province}}', ['center_id' => 23], ['id' => 23]);
        $this->update('{{%province}}', ['center_id' => 24], ['id' => 24]);
        $this->update('{{%province}}', ['center_id' => 25], ['id' => 25]);
        $this->update('{{%province}}', ['center_id' => 26], ['id' => 26]);
        $this->update('{{%province}}', ['center_id' => 27], ['id' => 27]);
        $this->update('{{%province}}', ['center_id' => 28], ['id' => 28]);
        $this->update('{{%province}}', ['center_id' => 29], ['id' => 29]);
        $this->update('{{%province}}', ['center_id' => 30], ['id' => 30]);
        $this->update('{{%province}}', ['center_id' => 31], ['id' => 31]);
        $this->update('{{%province}}', ['center_id' => 32], ['id' => 32]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
    }
}
