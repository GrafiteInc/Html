<?php

namespace Grafite\Html\Tags;

use Grafite\Html\Tags\HtmlComponent;

class DropdownDivider extends HtmlComponent
{
    public static function process()
    {
        self::$html = '<div class="dropdown-divider"></div>';
    }
}
