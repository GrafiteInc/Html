<?php

namespace Grafite\Html\Tags;

use Grafite\Html\Tags\HtmlComponent;

class DropdownItem extends HtmlComponent
{
    public static function process()
    {
        $url = self::$url;
        $text = self::$text;

        self::$html = "<a class=\"dropdown-item\" href=\"$url\">$text</a>";
    }
}
