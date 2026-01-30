<?php

namespace Grafite\Html\Tags;

use Illuminate\Support\Str;

class Divider extends HtmlComponent
{
    public static function styles()
    {
        return <<<'CSS'
            .html-hr-text {
                border: 0;
                line-height: 1em;
                position: relative;
                text-align: center;
                height: 2em;
                font-size: 18px;
                margin: 30px 15px;
            }

            .html-hr-text::before {
                content: "";
                background: linear-gradient(to right, transparent, var(--bs-body-color), transparent);
                position: absolute;
                left: 0;
                top: 50%;
                width: 100%;
                height: 1px;
            }

            .html-hr-text::after {
                content: attr(data-content);
                position: relative;
                padding: 0 12px;
                line-height: 2em;
                color: var(--bs-body-color);
                background-color: var(--bs-body-bg);
            }
        CSS;
    }

    public static function process()
    {
        self::$id = static::$attributes['id'] ?? 'html_'.Str::uuid();
        $id = self::$id;
        $text = self::$text ?? '';

        self::$html = <<<HTML
            <hr id="{$id}" class="html-hr-text" data-content="{$text}">
        HTML;
    }
}
