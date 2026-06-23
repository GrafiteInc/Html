<?php

namespace Grafite\Html\Tags;

use Illuminate\Support\Str;

class GridPattern extends HtmlComponent
{
    public static $content;

    public static $variant;

    public static $size;

    public static $color;

    public static $strokeWidth;

    public static function content($value)
    {
        self::$content = $value;

        return new static;
    }

    public static function variant($value)
    {
        self::$variant = $value;

        return new static;
    }

    public static function size($value)
    {
        self::$size = $value;

        return new static;
    }

    public static function color($value)
    {
        self::$color = $value;

        return new static;
    }

    public static function strokeWidth($value)
    {
        self::$strokeWidth = $value;

        return new static;
    }

    public static function stylesheets()
    {
        return [];
    }

    public static function scripts()
    {
        return [];
    }

    public static function js()
    {
        return '';
    }

    public static function styles()
    {
        return <<<'CSS'
        .html-grid-pattern {
            position: relative;
            width: 100%;
        }

        .html-grid-pattern-content {
            position: relative;
            z-index: 1;
        }
        CSS;
    }

    public static function process()
    {
        self::$id = static::$attributes['id'] ?? 'html_'.Str::uuid();

        $id = self::$id;
        $css = self::$css ?? '';
        $content = self::$content ?? '';
        $variant = self::$variant ?? 'lines';
        $size = self::$size ?? 40;
        $color = self::$color ?? 'rgba(0, 0, 0, 0.1)';
        $strokeWidth = self::$strokeWidth ?? 1;

        if ($variant === 'dots') {
            $background = "radial-gradient({$color} {$strokeWidth}px, transparent {$strokeWidth}px)";
            $backgroundSize = "{$size}px {$size}px";
        } else {
            $background = "linear-gradient(to right, {$color} {$strokeWidth}px, transparent {$strokeWidth}px), linear-gradient(to bottom, {$color} {$strokeWidth}px, transparent {$strokeWidth}px)";
            $backgroundSize = "{$size}px {$size}px";
        }

        self::$html = <<<HTML
            <div id="{$id}" class="html-grid-pattern {$css}" style="background-image: {$background}; background-size: {$backgroundSize};">
                <div class="html-grid-pattern-content">{$content}</div>
            </div>
        HTML;
    }
}
