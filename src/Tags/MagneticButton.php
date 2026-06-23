<?php

namespace Grafite\Html\Tags;

use Illuminate\Support\Str;

class MagneticButton extends HtmlComponent
{
    public static $content;

    public static $strength;

    public static $radius;

    public static function content($value)
    {
        self::$content = $value;

        return new static;
    }

    public static function strength($value)
    {
        self::$strength = $value;

        return new static;
    }

    public static function radius($value)
    {
        self::$radius = $value;

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

    public static function styles()
    {
        return <<<'CSS'
        .html-magnetic-button {
            display: inline-block;
            transition: transform 0.2s cubic-bezier(0.23, 1, 0.32, 1);
            will-change: transform;
        }
        CSS;
    }

    public static function js()
    {
        $id = self::$id;
        $strength = self::$strength ?? 0.3;
        $radius = self::$radius ?? 0;

        return <<<JS
            document.addEventListener('DOMContentLoaded', function () {
                const el = document.getElementById('{$id}');

                if (! el) {
                    return;
                }

                const strength = {$strength};
                const radius = {$radius};

                el.addEventListener('mousemove', function (event) {
                    const rect = el.getBoundingClientRect();
                    const relX = event.clientX - rect.left - rect.width / 2;
                    const relY = event.clientY - rect.top - rect.height / 2;

                    if (radius > 0 && Math.hypot(relX, relY) > radius) {
                        el.style.transform = 'translate(0px, 0px)';
                        return;
                    }

                    el.style.transform = 'translate(' + (relX * strength) + 'px, ' + (relY * strength) + 'px)';
                });

                el.addEventListener('mouseleave', function () {
                    el.style.transform = 'translate(0px, 0px)';
                });
            });
        JS;
    }

    public static function process()
    {
        self::$id = static::$attributes['id'] ?? 'html_'.Str::uuid();

        $id = self::$id;
        $css = self::$css ?? '';
        $url = self::$url;
        $content = self::$content ?? self::$text ?? '';

        if ($url) {
            self::$html = <<<HTML
                <a id="{$id}" href="{$url}" class="html-magnetic-button {$css}">{$content}</a>
            HTML;
        } else {
            self::$html = <<<HTML
                <button id="{$id}" type="button" class="html-magnetic-button {$css}">{$content}</button>
            HTML;
        }
    }
}
