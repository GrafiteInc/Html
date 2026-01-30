<?php

namespace Grafite\Html\Tags;

class HtmlTagComponent extends HtmlComponent
{
    public static function process()
    {
        self::$html = static::template();
    }
}
