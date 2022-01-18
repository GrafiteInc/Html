<?php

namespace Grafite\Html\Tags;

use Grafite\Html\Tags\HtmlComponent;

class Progress extends HtmlComponent
{
    public static $now;
    public static $min;
    public static $max;

    public static function now($value)
    {
        self::$now = $value;

        return new static;
    }

    public static function min($value)
    {
        self::$min = $value;

        return new static;
    }

    public static function max($value)
    {
        self::$max = $value;

        return new static;
    }

    public static function process()
    {
        $css = self::$css;
        $now = self::$now;
        $min = self::$min ?? 0;
        $max = self::$max ?? 100;

        self::$html = <<<html
        <div class="progress">
            <div class="progress-bar ${css}" role="progressbar" style="width: {$now}%" aria-valuenow="${now}" aria-valuemin="${min}" aria-valuemax="${max}"></div>
        </div>
html;
    }
}
