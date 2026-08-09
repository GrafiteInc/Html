<?php

namespace Grafite\Html\Tags;

use Illuminate\Support\Str;

class Dock extends HtmlComponent
{
    public static $position;

    public static $size;

    public static $magnify;

    public static $fixed;

    public static function position($value)
    {
        self::$position = $value;

        return new static;
    }

    public static function size($value)
    {
        self::$size = $value;

        return new static;
    }

    public static function magnify($value)
    {
        self::$magnify = $value;

        return new static;
    }

    public static function fixed($value)
    {
        self::$fixed = $value;

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
        .html-dock {
            width: fit-content;
            list-style: none;
        }

        .html-dock-item {
            position: relative;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            background: none;
            border: none;
            padding: 0.25rem;
            border-radius: 0.75rem;
            transition: transform 0.15s ease, background-color 0.15s ease;
            color: inherit;
            text-decoration: none;
        }

        .html-dock-item:hover {
            background-color: var(--bs-tertiary-bg, rgba(0, 0, 0, 0.05));
        }

        .html-dock-sm .html-dock-item {
            width: 2rem;
            height: 2rem;
            font-size: 1rem;
        }

        .html-dock-md .html-dock-item {
            width: 2.75rem;
            height: 2.75rem;
            font-size: 1.25rem;
        }

        .html-dock-lg .html-dock-item {
            width: 3.5rem;
            height: 3.5rem;
            font-size: 1.5rem;
        }

        .html-dock-item-active-dot {
            position: absolute;
            bottom: 2px;
            left: 50%;
            transform: translateX(-50%);
            width: 4px;
            height: 4px;
            border-radius: 50%;
            background-color: currentColor;
        }

        .html-dock-fixed {
            position: fixed;
            z-index: 1030;
        }

        .html-dock-fixed.html-dock-bottom {
            bottom: 1rem;
            left: 50%;
            transform: translateX(-50%);
        }

        .html-dock-fixed.html-dock-top {
            top: 1rem;
            left: 50%;
            transform: translateX(-50%);
        }

        .html-dock-fixed.html-dock-left {
            left: 1rem;
            top: 50%;
            transform: translateY(-50%);
        }

        .html-dock-fixed.html-dock-right {
            right: 1rem;
            top: 50%;
            transform: translateY(-50%);
        }
        CSS;
    }

    public static function js()
    {
        if (! (self::$magnify ?? true)) {
            return '';
        }

        $id = self::$id;
        $position = self::$position ?? 'bottom';
        $horizontal = in_array($position, ['left', 'right']) ? 'false' : 'true';

        return <<<JS
            document.addEventListener('DOMContentLoaded', function () {
                const dock = document.getElementById('{$id}');

                if (! dock) {
                    return;
                }

                const horizontal = {$horizontal};
                const items = Array.from(dock.querySelectorAll('.html-dock-item'));
                const maxScale = 1.6;
                const influence = 80;

                dock.addEventListener('mousemove', function (event) {
                    items.forEach(function (item) {
                        const rect = item.getBoundingClientRect();
                        const center = horizontal ? (rect.left + rect.width / 2) : (rect.top + rect.height / 2);
                        const pointer = horizontal ? event.clientX : event.clientY;
                        const distance = Math.abs(pointer - center);
                        const scale = 1 + Math.max(0, (influence - distance) / influence) * (maxScale - 1);

                        item.style.transform = 'scale(' + scale + ')';
                    });
                });

                dock.addEventListener('mouseleave', function () {
                    items.forEach(function (item) {
                        item.style.transform = 'scale(1)';
                    });
                });
            });
        JS;
    }

    protected static function renderItem($item)
    {
        $label = $item['label'] ?? '';
        $href = $item['href'] ?? null;
        $icon = $item['icon'] ?? '';
        $active = $item['active'] ?? false;

        $tag = $href ? 'a' : 'button';
        $hrefAttr = $href ? " href=\"{$href}\"" : '';
        $typeAttr = $href ? '' : ' type="button"';
        $activeDot = $active ? '<span class="html-dock-item-active-dot"></span>' : '';

        return <<<HTML
        <{$tag}{$hrefAttr}{$typeAttr} class="html-dock-item" title="{$label}" aria-label="{$label}">
            {$icon}
            {$activeDot}
        </{$tag}>
        HTML;
    }

    public static function process()
    {
        self::$id = static::$attributes['id'] ?? 'html_'.Str::uuid();

        $id = self::$id;
        $items = self::$items ?? [];
        $position = self::$position ?? 'bottom';
        $size = self::$size ?? 'md';
        $fixed = self::$fixed ?? false;
        $css = self::$css ?? '';

        $flexDirection = in_array($position, ['left', 'right']) ? 'flex-column' : 'flex-row';

        $modifiers = trim(
            "html-dock-{$position} html-dock-{$size} {$flexDirection}".
            ($fixed ? ' html-dock-fixed' : '')
        );

        $itemsHtml = '';

        foreach ($items as $item) {
            $itemsHtml .= self::renderItem($item);
        }

        self::$html = <<<HTML
        <div id="{$id}" role="toolbar" aria-label="Application dock" class="html-dock d-flex {$modifiers} align-items-center gap-2 rounded-pill shadow bg-body-secondary p-2 {$css}">
            {$itemsHtml}
        </div>
        HTML;
    }
}
