<?php

namespace Grafite\Html\Tags;

use Illuminate\Support\Str;

class GradientBackground extends HtmlComponent
{
    public static $content;

    public static $colors;

    public static $direction;

    public static $animate;

    public static $duration;

    public static function content($value)
    {
        self::$content = $value;

        return new static;
    }

    public static function colors($value)
    {
        self::$colors = $value;

        return new static;
    }

    public static function direction($value)
    {
        self::$direction = $value;

        return new static;
    }

    public static function animate($value = true)
    {
        self::$animate = $value;

        return new static;
    }

    public static function duration($value)
    {
        self::$duration = $value;

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
        .html-gradient-background {
            position: relative;
            width: 100%;
        }

        .html-gradient-background.html-gradient-animate {
            background-size: 200% 200%;
            animation: html-gradient-shift var(--html-gradient-duration, 8s) ease infinite;
        }

        @keyframes html-gradient-shift {
            0% {
                background-position: 0% 50%;
            }
            50% {
                background-position: 100% 50%;
            }
            100% {
                background-position: 0% 50%;
            }
        }
        CSS;
    }

    public static function process()
    {
        self::$id = static::$attributes['id'] ?? 'html_'.Str::uuid();

        $id = self::$id;
        $css = self::$css ?? '';
        $content = self::$content ?? '';
        $colors = self::$colors ?? ['#ee7752', '#e73c7e', '#23a6d5', '#23d5ab'];
        $direction = self::$direction ?? '135deg';
        $duration = self::$duration ?? '8s';
        $animate = self::$animate ? 'html-gradient-animate' : '';

        $colorStops = implode(', ', $colors);

        self::$html = <<<HTML
            <div id="{$id}" class="html-gradient-background {$animate} {$css}" style="background-image: linear-gradient({$direction}, {$colorStops}); --html-gradient-duration: {$duration};">
                {$content}
            </div>
        HTML;
    }
}
