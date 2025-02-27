<?php

namespace Grafite\Html\Tags;

use Grafite\Html\Tags\HtmlComponent;

class Popover extends HtmlComponent
{
    public static $title;
    public static $css;
    public static $trigger;
    public static $content;

    public static function title($value)
    {
        self::$title = $value;

        return new static();
    }

    public static function css($value)
    {
        self::$css = $value;

        return new static();
    }

    public static function trigger($value)
    {
        self::$trigger = $value;

        return new static();
    }

    public static function content($value)
    {
        self::$content = $value;

        return new static();
    }

    public static function js()
    {
        $id = self::$id;
        $trigger = self::$trigger ?? 'click';

        $hide = 0;
        if ($trigger === 'hover') {
            $hide = 2000;
        }

        $content = str_replace("\n", "", self::$content ?? '');

        return <<<JS
            document.addEventListener('DOMContentLoaded', (event) => {
                const popoverTriggerList = document.querySelectorAll('[data-bs-toggle="popover"]')
                const popoverList = [...popoverTriggerList].map(popoverTriggerEl => new bootstrap.Popover(popoverTriggerEl, {
                    html: true,
                    container: 'body',
                    content: '$content',
                    delay: { "show": 0, "hide": $hide },
                    template: '<div class="popover html-popover shadow-sm" role="tooltip"><div class="popover-header"></div><div class="popover-body"></div></div>'
                }))
            });
        JS;
    }

    public static function styles()
    {
        return <<<CSS

        CSS;
    }

    public static function process()
    {
        $css = self::$css ?? 'btn btn-secondary';
        $title = self::$title ?? '';
        $trigger = self::$trigger ?? 'click';

        self::$html = <<<html
                <button type="button" class="$css"
                    data-bs-toggle="popover"
                    data-bs-trigger="$trigger"
                    data-bs-custom-class="html-popover"
                >
                $title
            </button>
html;
    }
}
