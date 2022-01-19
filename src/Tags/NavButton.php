<?php

namespace Grafite\Html\Tags;

use Grafite\Html\Tags\HtmlComponent;

class NavButton extends HtmlComponent
{
    public static function process()
    {
        $class = '';

        if (self::$css) {
            $class = self::$css;
        }

        $text = self::$text;

        $attributes = self::processAttributes([
            'onclick' => self::$onClick,
            'class' => 'nav-link ' . $class
        ]);

        $active = (request()->url() === self::$url) ? ' active' : '';

        self::$html = <<<html
        <li class="nav-item$active">
            <button$attributes>$text</button>
        </li>
html;
    }
}
