<?php

namespace Grafite\Html\Tags;

use Grafite\Html\Tags\HtmlComponent;

class Admonition extends HtmlComponent
{
    public static $body;
    public static $title;
    public static $icon;
    public static $color;

    public static function body($value)
    {
        self::$body = $value;

        return new static();
    }

    public static function title($value)
    {
        self::$title = $value;

        return new static();
    }

    public static function icon($value)
    {
        self::$icon = $value;

        return new static();
    }

    public static function color($value)
    {
        self::$color = $value;

        return new static();
    }

    public static function process()
    {
        $body = self::$body;
        $title = self::$title;
        $color = self::$color;
        $icon = self::$icon;

        $bodyHtml = ($body) ? $body : '';
        $iconHtml = ($icon) ? "<i class=\"fa fa-$icon\"></i>" : '';
        $titleHtml = ($title) ? "<span class=\"card-title\">$iconHtml $title</span>" : '';

        self::$html = <<<html
        <div class="card shadow-sm border-$color mb-3">
            <div class="card-header bg-$color text-white border-0">
                $titleHtml
            </div>
            <div class="card-body">
                $bodyHtml
            </div>
        </div>
html;
    }
}
