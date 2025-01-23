<?php

namespace Grafite\Html\Tags;

use Grafite\Html\Tags\HtmlComponent;

class Badge extends HtmlComponent
{
    public static $name;
    public static $status;
    public static $color;
    public static $theme;
    public static $icon;

    public static function name($value)
    {
        self::$name = $value;

        return new static();
    }

    public static function status($value)
    {
        self::$status = $value;

        return new static();
    }

    public static function color($value)
    {
        self::$color = $value;

        return new static();
    }

    public static function theme($value)
    {
        self::$theme = $value;

        return new static();
    }

    public static function icon($value)
    {
        self::$icon = $value;

        return new static();
    }

    public static function process()
    {
        $name = self::$name;
        $status = self::$status;
        $color = self::$color;
        $theme = self::$theme;
        $icon = self::$icon;

        if (! in_array($theme, ['flat', 'flat-square', 'for-the-badge', 'plastic', 'social'])) {
            throw new \Exception("Error Processing Theme", 1);
        }

        $contents = file_get_contents("https://img.shields.io/badge/$name-$status-$color?style=$theme&logo=$icon");

        self::$html = $contents;
    }
}
