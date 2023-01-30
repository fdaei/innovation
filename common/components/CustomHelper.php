<?php
namespace common\components;

use yii\base\Component;
use yii\helpers\HtmlPurifier;

class CustomHelper extends Component
{
    public static function purifiesFroalaContent($content)
    {
        if (str_contains($content, 'Powered by')) {
            $content = preg_replace('~<p\s+data-f-id.*$~', '', $content); //(Remove Froala License)
        }
        //remove inline style attribute from html tag
        $content = preg_replace('/(<[^>]+) style=".*?"/i', '$1', $content);
        return HtmlPurifier::process($content, function ($config) {
            $config->set('HTML.Doctype', 'HTML 4.01 Transitional');
            $config->set('HTML.DefinitionID', 'html5-definitions');
            $config->set('HTML.DefinitionRev', 1);
            if ($def = $config->maybeGetRawHTMLDefinition()) {
                $def->addElement('video', 'Block', 'Optional: (source, Flow) | (Flow, source) | Flow', 'Common', array(
                    'src' => 'URI',
                    'type' => 'Text',
                    'width' => 'Length',
                    'height' => 'Length',
                    'poster' => 'URI',
                    'preload' => 'Enum#auto,metadata,none',
                    'controls' => 'Bool',
                ));
            }
        });
    }

    public function toEn($string)
    {
        $persian = ['۰', '۱', '۲', '۳', '۴', '۵', '۶', '۷', '۸', '۹'];
        //$arabic = ['٩', '٨', '٧', '٦', '٥', '٤', '٣', '٢', '١','٠'];
        $arabic = ['٠', '١', '٢', '٣', '٤', '٥', '٦', '٧', '٨', '٩'];

        $num =['0','1','2','3','4','5','6','7','8','9'];
        $convertedPersianNums = str_replace($persian, $num, $string);
        $englishNumbersOnly = str_replace($arabic, $num, $convertedPersianNums);

        return $englishNumbersOnly;
    }
    public function toFa($string)
    {
        $persian = ['۰', '۱', '۲', '۳', '۴', '۵', '۶', '۷', '۸', '۹'];
        //$arabic = ['٩', '٨', '٧', '٦', '٥', '٤', '٣', '٢', '١','٠'];
        $arabic = ['٠', '١', '٢', '٣', '٤', '٥', '٦', '٧', '٨', '٩'];

        $num =['0','1','2','3','4','5','6','7','8','9'];
        $converteEnglishNumber = str_replace($num,$persian,$string);

        return $converteEnglishNumber;
    }
}