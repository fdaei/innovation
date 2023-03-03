<?php

namespace backend\models;
use yii\base\Model;

class MentorRecords extends Model
{

    public $isNewRecord = true;
    public $year;
    public $title;
    public $description;

    public function rules()
    {
        return [
            [['year','title','description'],'required'],
            [['year','title','description'],'string'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'year' => 'سال',
            'title' => 'عنوان سابقه',
            'description' => 'توضیح سابقه',
        ];
    }
}