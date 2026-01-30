<?php

namespace Grafite\Html\Tags;

class NavLink extends HtmlComponent
{
    public static function process()
    {
        $text = self::$text;

        $attributes = self::processAttributes([
            'href' => self::$url,
            'class' => 'nav-link',
        ]);

        $active = (request()->url() === self::$url) ? ' active' : '';

        self::$html = <<<html
        <li class="nav-item$active">
            <a$attributes>$text</a>
        </li>
html;
    }
}
