<?php

namespace Grafite\Html\Tags;

class Spinner extends HtmlComponent
{
    public static function process()
    {
        $css = self::$css;

        self::$html = <<<html
        <div class="spinner-border ${css}" role="status">
            <span class="sr-only">Loading...</span>
        </div>
html;
    }
}
