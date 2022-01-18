<?php

namespace Grafite\Html\Tags;

use Grafite\Html\Tags\HtmlComponent;

class NavLink extends HtmlComponent
{
    public static $url;
    public static $css = 'nav-link';

    public static function url($url)
    {
        self::$url = $url;

        return new static;
    }

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
