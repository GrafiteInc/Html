<?php

namespace Grafite\Html\Tags;

use Illuminate\Support\Str;

class OffCanvas extends HtmlComponent
{
    public static $position;

    public static function position($position)
    {
        self::$position = $position;

        return new static();
    }

    public static function process()
    {
        $css = self::$css ?? '';
        $text = self::$text ?? '';
        $position = self::$position ?? 'end';
        $id = self::$id ?? 'html_component_offcanvas_' . Str::uuid();


        self::$html = <<<html
            <div id="offCanvas_{$id}" class="offcanvas offcanvas-{$position}" ref="offcanvas-panel" tabindex="-1" aria-labelledby="offcanvasLabel_{$id}">
                <div class="offcanvas-header">
                    <h5 id="offcanvasLabel_{$id}">{$text}</h5>
                    <button type="button" class="btn-close bg-secondary text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                </div>
                <div class="offcanvas-body">
                    {{ \$slot }}
                </div>
            </div>
            <button class="{$css}" type="button" data-bs-toggle="offcanvas" data-bs-target="#offCanvas_{$id}" aria-controls="offCanvas_{$id}">
                {$text}
            </button>
html;
    }
}
