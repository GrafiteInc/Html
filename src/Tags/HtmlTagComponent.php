<?php

namespace Grafite\Html\Tags;

use Grafite\Html\Tags\HtmlComponent;

class HtmlTagComponent extends HtmlComponent
{
    public static function process()
    {
        self::$html = static::template();
    }
}
