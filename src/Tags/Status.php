<?php

namespace Grafite\Html\Tags;

class Status extends HtmlComponent
{
    public static $color;

    public static $thickness;

    public static $style;

    public static $offset;

    public static $state;

    public static function color($value)
    {
        self::$color = $value;

        return new static;
    }

    public static function thickness($value)
    {
        self::$thickness = $value;

        return new static;
    }

    public static function style($value)
    {
        self::$style = $value;

        return new static;
    }

    public static function offset($value)
    {
        self::$offset = $value;

        return new static;
    }

    public static function state($value)
    {
        self::$state = $value;

        return new static;
    }

    public static function process()
    {
        $color = self::$color ?? 'green';
        $thickness = self::$thickness ?? '2';
        $style = self::$style ?? 'solid';
        $offset = self::$offset ?? '2';
        $state = self::$state ?? 'Active';


        $contents = <<< HTML
<span class="badge bmx-bg-{$color} rounded-circle p-2 bmx-pulse bmx-animation-continuous m-1 bmx-outline-{$color} bmx-outline-{$thickness} bmx-outline-offset-{$offset} bmx-outline-{$style}">
    <span class="visually-hidden">{$state}</span>
</span>
HTML;

        self::$html = (string) $contents;
    }
}
