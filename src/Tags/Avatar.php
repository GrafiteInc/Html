<?php

namespace Grafite\Html\Tags;

use Grafite\Html\Tags\HtmlComponent;

class Avatar extends HtmlComponent
{
    public static $size;
    public static $image;
    public static $css;

    public static function size($value)
    {
        self::$size = $value;

        return new static();
    }

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
        $size = self::$size;
        $css = self::$css;

        if ($size) {
            $size = '-'.$size;
        }

        self::$html = <<<html
        <div class="html-component-avatar$size $css" style="background-image: url($image);"></div>
html;
    }

    public static function styles()
    {
        return <<<styles
.html-component-avatar {
    width: 200px;
    height: 200px;
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

.html-component-avatar-md {
    width: 48px;
    height: 48px;
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
