<?php

namespace Grafite\Html\Tags;

use Illuminate\Support\Str;

class Swap extends HtmlComponent
{
    public static $on;

    public static $off;

    public static $active;

    public static $rotate;

    public static $flip;

    public static function on($value)
    {
        self::$on = $value;

        return new static;
    }

    public static function off($value)
    {
        self::$off = $value;

        return new static;
    }

    public static function active($value)
    {
        self::$active = $value;

        return new static;
    }

    public static function rotate($value)
    {
        self::$rotate = $value;

        return new static;
    }

    public static function flip($value)
    {
        self::$flip = $value;

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
        .html-swap {
            position: relative;
            display: inline-grid;
            place-items: center;
            cursor: pointer;
            background: none;
            border: none;
            padding: 0;
        }

        .html-swap-on,
        .html-swap-off {
            grid-column: 1;
            grid-row: 1;
            transition: transform 0.2s ease, opacity 0.2s ease;
        }

        .html-swap-off {
            opacity: 1;
            transform: scale(1);
        }

        .html-swap-on {
            opacity: 0;
            transform: scale(0.65);
        }

        .html-swap-active .html-swap-on {
            opacity: 1;
            transform: scale(1);
        }

        .html-swap-active .html-swap-off {
            opacity: 0;
            transform: scale(0.65);
        }

        .html-swap-rotate .html-swap-on,
        .html-swap-rotate .html-swap-off {
            transition: transform 0.4s ease, opacity 0.2s ease;
        }

        .html-swap-rotate .html-swap-off {
            transform: rotate(0deg);
        }

        .html-swap-rotate .html-swap-on {
            transform: rotate(-45deg) scale(0.65);
        }

        .html-swap-rotate.html-swap-active .html-swap-on {
            transform: rotate(0deg) scale(1);
        }

        .html-swap-rotate.html-swap-active .html-swap-off {
            transform: rotate(45deg) scale(0.65);
        }

        .html-swap-flip .html-swap-on,
        .html-swap-flip .html-swap-off {
            transition: transform 0.4s ease, opacity 0.2s ease;
            backface-visibility: hidden;
        }

        .html-swap-flip .html-swap-on {
            transform: scaleX(-1) scale(0.65);
        }

        .html-swap-flip.html-swap-active .html-swap-on {
            transform: scaleX(1) scale(1);
        }

        .html-swap-flip.html-swap-active .html-swap-off {
            transform: scaleX(-1) scale(0.65);
        }
        CSS;
    }

    public static function js()
    {
        $id = self::$id;

        return <<<JS
            document.addEventListener('DOMContentLoaded', function () {
                const el = document.getElementById('{$id}');

                if (! el) {
                    return;
                }

                el.addEventListener('click', function () {
                    const active = el.classList.toggle('html-swap-active');

                    el.setAttribute('aria-checked', active ? 'true' : 'false');
                });
            });
        JS;
    }

    public static function process()
    {
        self::$id = static::$attributes['id'] ?? 'html_'.Str::uuid();

        $id = self::$id;
        $css = self::$css ?? '';
        $on = self::$on ?? '';
        $off = self::$off ?? '';
        $active = self::$active ?? false;
        $rotate = self::$rotate ?? false;
        $flip = self::$flip ?? false;

        $modifiers = trim(
            ($active ? ' html-swap-active' : '').
            ($rotate ? ' html-swap-rotate' : '').
            ($flip ? ' html-swap-flip' : '')
        );

        $ariaChecked = $active ? 'true' : 'false';

        self::$html = <<<HTML
        <button type="button" id="{$id}" role="switch" aria-checked="{$ariaChecked}" class="html-swap {$modifiers} {$css}">

            <span class="html-swap-on">{$on}</span>
            <span class="html-swap-off">{$off}</span>
        </button>
        HTML;
    }
}
