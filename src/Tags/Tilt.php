<?php

namespace Grafite\Html\Tags;

use Illuminate\Support\Str;
use Grafite\Html\Tags\HtmlComponent;

class Tilt extends HtmlComponent
{
    public static $content;
    public static $startX = 20;
    public static $startY = -20;
    public static $glare = 'false';

    public static function content($value)
    {
        self::$content = $value;

        return new static();
    }

    public static function startX($value)
    {
        self::$startX = $value;

        return new static();
    }

    public static function startY($value)
    {
        self::$startY = $value;

        return new static();
    }

    public static function glare($value)
    {
        self::$glare = $value;

        return new static();
    }

    public static function stylesheets()
    {
        return [
            '',
        ];
    }

    public static function scripts()
    {
        return [
            '//cdn.jsdelivr.net/npm/vanilla-tilt@1.8.0/dist/vanilla-tilt.min.js',
        ];
    }

    public static function js()
    {
        $id = self::$id;
        $startX = self::$startX;
        $startY = self::$startY;
        $glare = self::$glare;

        return <<<JS
            VanillaTilt.init(document.querySelector("#{$id}"), {
                "reset-to-start": true,
                glare: {$glare},
                startX: {$startX},
                startY: {$startY}
            });
        JS;
    }

    public static function styles()
    {
        return <<<CSS
            .tilt-container {
                display: inline-block;
                filter: drop-shadow(0 6mm 4mm rgba(0, 0, 0, 0.4));
            }
        CSS;
    }

    public static function process()
    {
        self::$id = static::$attributes['id'] ?? 'html_' . Str::uuid();

        $id = self::$id;
        $content = self::$content;

        self::$html = "<div id=\"{$id}\" class=\"tilt-container\">{$content}</div>";
    }
}
