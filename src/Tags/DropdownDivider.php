<?php

namespace Grafite\Html\Tags;

class DropdownDivider extends HtmlComponent
{
    public static function process()
    {
        self::$html = '<div class="dropdown-divider"></div>';
    }
}
