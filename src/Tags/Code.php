<?php

namespace Grafite\Html\Tags;

use Tempest\Highlight\Highlighter;
use Grafite\Html\Tags\HtmlComponent;
use Tempest\Highlight\Themes\InlineTheme;

class Code extends HtmlComponent
{
    public static $body = '';
    public static $language = 'php';

    public static function body($value)
    {
        self::$body = $value;

        return new static();
    }

    public static function language($value)
    {
        self::$language = $value;

        return new static();
    }

    public static function process()
    {
        $body = self::$body ?? '';
        $language = self::$language ?? 'php';

        $highlighter = new Highlighter(new InlineTheme(__DIR__ . '/../../../../tempest/highlight/src/Themes/Css/highlight-light-lite.css'));

        $code = $highlighter->parse($body, $language);

        self::$html = <<<html
        <pre class="border rounded p-3 bg-body-tertiary">{$code}</pre>
html;
    }
}
