<?php

namespace Grafite\Html\Tags;

use Grafite\Html\Tags\HtmlComponent;

class Rating extends HtmlComponent
{
    public static $value;
    public static $max;

    public static function max($value)
    {
        self::$max = $value;

        return new static();
    }

    public static function value($value)
    {
        self::$value = $value;

        return new static();
    }

    public static function process()
    {
        $max = self::$max ?? 5;
        $value = self::$value;
        $value = floor($value);

        $rating = '';

        foreach (range(1, $value) as $filledStar) {
            $rating .= '<span class="fa fa-star text-primary"></span>';
        }

        foreach (range(1, $max - $value) as $emptyStar) {
            $rating .= '<span class="fa fa-regular fa-star"></span>';
        }

        self::$html = "<div>{$rating}</div>";
    }
}
