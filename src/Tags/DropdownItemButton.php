<?php

namespace Grafite\Html\Tags;

class DropdownItemButton extends HtmlComponent
{
    public static function process()
    {
        $onClick = self::$onClick;
        $text = self::$text;

        self::$html = "<button class=\"dropdown-item\" onclick=\"$onClick\">$text</button>";
    }
}
