<?php

namespace Grafite\Html\Tags;

use Illuminate\Support\Str;
use Grafite\Html\Tags\HtmlComponent;

class DropdownButtonAction extends HtmlComponent
{
    public static function process()
    {
        $id = self::$id ?? 'html_' . Str::uuid();
        $css = self::$css;
        $menuCss = self::$menuCss;
        $text = self::$text;
        $items = collect(self::$items)->implode("\n");

        self::$html = <<<html
            <div class="btn-group" role="group">
                <button type="button" class="btn $css">$text</button>
                <button type="button" class="btn $css dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" data-bs-toggle="dropdown" aria-expanded="false">
                    <span class="sr-only">Toggle Dropdown</span>
                </button>
                <div class="dropdown-menu $menuCss" aria-labelledby="$id">
                    $items
                </div>
            </div>
html;
    }
}
