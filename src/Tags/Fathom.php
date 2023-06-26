<?php

namespace Grafite\Html\Tags;

use Grafite\Html\Tags\HtmlComponent;

class Fathom extends HtmlComponent
{
    public static function process()
    {
        $key = config('services.fathom.key');

        self::$html = <<<HTML
<script src="https://cdn.usefathom.com/script.js" data-site="{$key}" defer></script>
HTML;
    }
}
