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
}