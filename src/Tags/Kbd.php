<?php

namespace Grafite\Html\Tags;

class Kbd extends HtmlComponent
{
    public static $size;

    public static function size($value)
    {
        self::$size = $value;

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
        .html-kbd {
            display: inline-block;
            font-family: var(--bs-font-monospace, SFMono-Regular, Consolas, "Liberation Mono", Menlo, monospace);
            line-height: 1;
            color: var(--bs-body-color);
            background-color: var(--bs-secondary-bg, #e9ecef);
            border: 1px solid var(--bs-border-color, #dee2e6);
            border-bottom-width: 2px;
            border-radius: 0.25rem;
            box-shadow: inset 0 -1px 0 var(--bs-border-color, #dee2e6);
            white-space: nowrap;
        }

        .html-kbd-sm {
            padding: 0.05rem 0.35rem;
            font-size: 0.75rem;
        }

        .html-kbd-md {
            padding: 0.15rem 0.5rem;
            font-size: 0.875rem;
        }

        .html-kbd-lg {
            padding: 0.25rem 0.65rem;
            font-size: 1rem;
        }
        CSS;
    }

    public static function process()
    {
        self::$id = static::$attributes['id'] ?? null;

        $id = self::$id ? ' id="'.self::$id.'"' : '';
        $size = self::$size ?? 'md';
        $css = self::$css ?? '';
        $text = self::$text ?? '';

        self::$html = <<<HTML
        <kbd{$id} class="html-kbd html-kbd-{$size} {$css}">{$text}</kbd>
        HTML;
    }
}
