<?php

namespace Grafite\Html\Tags;

use Illuminate\Support\Str;

class OffCanvas extends HtmlComponent
{
    public static $position;

    public static $backdrop;

    public static $width;

    public static function position($position)
    {
        self::$position = $position;

        return new static();
    }

    public static function backdrop($backdrop)
    {
        self::$backdrop = $backdrop;

        return new static();
    }

    public static function width($width)
    {
        self::$width = $width;

        return new static();
    }

    public static function process()
    {
        $css = self::$css ?? '';
        $text = self::$text ?? '';
        $width = self::$width ?? '';
        $position = self::$position ?? 'end';
        $backdrop = self::$backdrop ?? 'true';
        $id = self::$id ?? 'html_component_offcanvas_' . Str::uuid();

        if ($width) {
            $width = "style=\"width: {$width};\"";
        }

        self::$html = <<<html
            <div id="offCanvas_{$id}" data-bs-backdrop="{$backdrop}" class="offcanvas offcanvas-{$position}" ref="offcanvas-panel" tabindex="-1" aria-labelledby="offcanvasLabel_{$id}" {$width}>
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
