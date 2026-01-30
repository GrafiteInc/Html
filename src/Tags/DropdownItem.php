<?php

namespace Grafite\Html\Tags;

class DropdownItem extends HtmlComponent
{
    public static function process()
    {
        $url = self::$url;
        $text = self::$text;
        $target = self::$attributes['target'] ?? '_self';

        self::$html = "<a class=\"dropdown-item\" target=\"$target\" href=\"$url\">$text</a>";
    }
}
