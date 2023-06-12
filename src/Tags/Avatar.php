<?php

namespace Grafite\Html\Tags;

use Grafite\Html\Tags\HtmlComponent;

class Avatar extends HtmlComponent
{
    public static $image;
    public static $css;

    public static function image($value)
    {
        self::$image = $value;

        return new static();
    }

    public static function css($value)
    {
        self::$css = $value;

        return new static();
    }

    public static function process()
    {
        $image = self::$image;
        $css = self::$css;

        self::$html = <<<html
        <div class="html-component-avatar $css" style="background-image: url($image);"></div>
html;
    }

    public static function styles()
    {
        return <<<styles
.html-component-avatar {
    min-width: 200px;
    min-height: 200px;
    border-radius: 50%;
    background-size: cover;
    background-position: center center;
}

.html-component-avatar-sm {
    width: 26px;
    height: 26px;
    border-radius: 50%;
    background-size: cover;
    background-position: center center;
    position: relative;
    border: 1px solid #FFF;
    display: inline-block;
    margin-left: -12px;
}
styles;
    }
}
