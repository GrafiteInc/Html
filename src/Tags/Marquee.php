<?php

namespace Grafite\Html\Tags;

use Illuminate\Support\Str;

class Marquee extends HtmlComponent
{
    public static $content;

    public static $reverse;

    public static $pauseOnHover;

    public static $vertical;

    public static $repeat;

    public static $duration;

    public static function content($value)
    {
        self::$content = $value;

        return new static;
    }

    public static function reverse($value = true)
    {
        self::$reverse = $value;

        return new static;
    }

    public static function pauseOnHover($value = true)
    {
        self::$pauseOnHover = $value;

        return new static;
    }

    public static function vertical($value = true)
    {
        self::$vertical = $value;

        return new static;
    }

    public static function repeat($value)
    {
        self::$repeat = $value;

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
        .html-marquee-container {
            position: relative;
            overflow: hidden;
            width: 100%;
            height: 100%;
        }

        .html-marquee-container.html-vertical {
            height: 400px;
            flex-direction: column;
        }

        .html-marquee {
            display: flex;
            gap: 1rem;
            animation-timing-function: linear;
            animation-iteration-count: infinite;
        }

        .html-marquee.html-horizontal {
            flex-direction: row;
            animation-name: html-scroll-horizontal;
        }

        .html-marquee.html-horizontal.html-reverse {
            animation-direction: reverse;
        }

        .html-marquee.html-vertical {
            flex-direction: column;
            animation-name: html-scroll-vertical;
        }

        .html-marquee.html-vertical.html-reverse {
            animation-direction: reverse;
        }

        .html-marquee.html-pause-on-hover:hover {
            animation-play-state: paused;
        }

        @keyframes html-scroll-horizontal {
            from {
                transform: translateX(0);
            }
            to {
                transform: translateX(-100%);
            }
        }

        @keyframes html-scroll-vertical {
            from {
                transform: translateY(0);
            }
            to {
                transform: translateY(-100%);
            }
        }
        CSS;
    }

    public static function process()
    {
        self::$id = static::$attributes['id'] ?? 'html_'.Str::uuid();

        $id = self::$id;
        $content = self::$content ?? '';
        $css = self::$css ?? '';
        $repeat = self::$repeat ?? 4;
        $duration = self::$duration ?? '40s';
        $vertical = self::$vertical ? 'html-vertical' : 'html-horizontal';
        $reverse = self::$reverse ? 'html-reverse' : '';
        $pauseOnHover = self::$pauseOnHover ? 'html-pause-on-hover' : '';

        $containerClass = $vertical === 'html-vertical' ? 'html-marquee-container html-vertical' : 'html-marquee-container';
        $marqueeClass = trim("{$vertical} {$reverse} {$pauseOnHover}");

        $repeatedContent = '';
        for ($i = 0; $i < $repeat; $i++) {
            $repeatedContent .= $content;
        }

        self::$html = <<<HTML
             <div id="{$id}" class="{$containerClass} {$css}">
                <div class="html-marquee {$marqueeClass}" style="animation-duration: {$duration};">
                    {$repeatedContent}
                </div>
            </div>
        HTML;
    }
}
