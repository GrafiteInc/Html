<?php

namespace Grafite\Html\Tags;

use Illuminate\Support\Str;
use Grafite\Html\Tags\HtmlComponent;

class DropdownButtonGroup extends HtmlComponent
{
    public static function process()
    {
        $id = static::$attributes['id'] ?? 'html_' . Str::uuid();
        $css = self::$css;
        $menuCss = self::$menuCss;
        $text = self::$text;
        $items = collect(self::$items)->implode("\n");

        self::$html = <<<html
    <div class="btn-group">
        <a class="btn dropdown-toggle $css" href="#" role="button" id="$id" data-toggle="dropdown" data-bs-toggle="dropdown" aria-expanded="false">
            $text
        </a>
        <div class="dropdown-menu $menuCss" aria-labelledby="$id">
            $items
        </div>
    </div>
html;
    }
}
