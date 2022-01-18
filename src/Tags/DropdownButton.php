<?php

namespace Grafite\Html\Tags;

use Illuminate\Support\Str;
use Grafite\Html\Tags\HtmlComponent;

class DropdownButton extends HtmlComponent
{
    public static function process()
    {
        $id = self::$id ?? 'html_'.Str::uuid();
        $css = self::$css;
        $text = self::$text;
        $items = collect(self::$items)->implode("\n");

        self::$html = <<<html
    <div class="dropdown">
        <a class="btn dropdown-toggle $css" href="#" role="button" id="$id" data-toggle="dropdown" data-bs-toggle="dropdown" aria-expanded="false">
            $text
        </a>
        <div class="dropdown-menu" aria-labelledby="$id">
            $items
        </div>
    </div>
html;
    }
}
