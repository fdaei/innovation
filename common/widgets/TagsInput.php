<?php
namespace common\widgets;
use dosamigos\selectize\SelectizeTextInput;

class TagsInput extends SelectizeTextInput
{
    public $options = ['class' => 'no-clear form-control'];
    public $loadUrl = ['tags/list'];
    public $clientOptions = [
        'plugins' => ['remove_button'],
        'valueField' => 'name',
        'labelField' => 'name',
        'searchField' => ['name'],
        'create' => true,
    ];
}