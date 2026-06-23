<?php

namespace Grafite\Html\Tags;

use Illuminate\Support\Str;

class LightBar extends HtmlComponent
{
    public static $content;

    public static $color;

    public static $position;

    public static $height;

    public static $blur;

    public static function content($value)
    {
        self::$content = $value;

        return new static;
    }

    public static function color($value)
    {
        self::$color = $value;

        return new static;
    }

    public static function position($value)
    {
        self::$position = $value;

        return new static;
    }

    public static function height($value)
    {
        self::$height = $value;

        return new static;
    }

    public static function blur($value)
    {
        self::$blur = $value;

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
        .html-light-bar {
            position: relative;
            overflow: hidden;
        }

        .html-light-bar-glow {
            position: absolute;
            left: 50%;
            transform: translateX(-50%);
            width: 60%;
            pointer-events: none;
            z-index: 0;
        }

        .html-light-bar-glow.html-light-bar-top {
            top: 0;
        }

        .html-light-bar-glow.html-light-bar-bottom {
            bottom: 0;
        }

        .html-light-bar-beam {
            width: 100%;
            border-radius: 9999px;
        }

        .html-light-bar-content {
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
        $color = self::$color ?? '#3b82f6';
        $position = self::$position === 'bottom' ? 'html-light-bar-bottom' : 'html-light-bar-top';
        $height = self::$height ?? '4px';
        $blur = self::$blur ?? '60px';

        self::$html = <<<HTML
            <div id="{$id}" class="html-light-bar {$css}">
                <div class="html-light-bar-glow {$position}" style="filter: blur({$blur});">
                    <div class="html-light-bar-beam" style="height: {$height}; background: radial-gradient(closest-side, {$color}, transparent);"></div>
                </div>
                <div class="html-light-bar-content">{$content}</div>
            </div>
        HTML;
    }
}
