<?php

namespace Grafite\Html\Tags;

use Grafite\Html\Tags\HtmlComponent;

class Nav extends HtmlComponent
{
    public static $type;

    public static function pills()
    {
        self::$type = 'pills';

        return new static();
    }

    public static function tabs()
    {
        self::$type = 'tabs';

        return new static();
    }

    public static function process()
    {
        $class = '';

        if (self::$type) {
            $class = 'nav-' . self::$type;
        }

        if (self::$css) {
            $class = " $class " . self::$css;
        }

        $attributes = self::processAttributes([
            'class' => trim('nav ' . $class),
        ]);

        $links = collect(self::$items)->implode("\n");

        self::$html = <<<html
<ul$attributes>
    \n$links\n
</ul>
html;
    }
}
