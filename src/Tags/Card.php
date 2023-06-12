<?php

namespace Grafite\Html\Tags;

use Grafite\Html\Tags\HtmlComponent;

class Card extends HtmlComponent
{
    public static $body;
    public static $title;
    public static $header;
    public static $footer;
    public static $imageSrc;
    public static $imageAlt;
    public static $shadow = 'shadow-sm';

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

    public static function header($value)
    {
        self::$header = $value;

        return new static();
    }

    public static function footer($value)
    {
        self::$footer = $value;

        return new static();
    }

    public static function image($value, $alt = null)
    {
        self::$imageSrc = $value;
        self::$imageAlt = $alt;

        return new static();
    }

    public static function shadow($value)
    {
        self::$shadow = $value;

        return new static();
    }

    public static function process()
    {
        $body = self::$body;
        $title = self::$title;
        $header = self::$header;
        $footer = self::$footer;
        $imageSrc = self::$imageSrc;
        $imageAlt = self::$imageAlt;
        $shadow = self::$shadow;

        $bodyHtml = ($body) ? $body : '';
        $imageAltHtml = ($imageAlt) ? $imageAlt : '';
        $titleHtml = ($title) ? "<h5 class=\"card-title\">$title</h5>" : '';
        $imageHtml = ($imageSrc) ? "<img src=\"$imageSrc\" class=\"card-img-top\" alt=\"$imageAltHtml\">" : '';
        $headerHtml = ($header) ? "<div class=\"card-header\">$header</div>" : '';
        $footerHtml = ($footer) ? "<div class=\"card-footer\">$footer</div>" : '';

        self::$html = <<<html
        <div class="card {$shadow}">
            $imageHtml
            $headerHtml
            <div class="card-body">
                $titleHtml
                $bodyHtml
            </div>
            $footerHtml
        </div>
html;
    }
}
