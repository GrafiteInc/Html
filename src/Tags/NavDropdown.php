<?php

namespace Grafite\Html\Tags;

use Grafite\Html\Tags\HtmlComponent;

class NavDropdown extends HtmlComponent
{
    public static function process()
    {
        $text = self::$text;
        $items = collect(self::$items)->implode("\n");

        self::$html = <<<html
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" data-toggle="dropdown" data-bs-toggle="dropdown" href="#" role="button" aria-expanded="false">$text</a>
            <div class="dropdown-menu">
                $items
            </div>
        </li>
html;
    }
}
