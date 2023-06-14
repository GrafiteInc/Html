<?php

namespace Grafite\Html\Tags;

use Grafite\Html\Tags\HtmlComponent;

class Image extends HtmlComponent
{
    public static $thumbnail = false;
    public static $fluid = false;
    public static $placeholder = false;
    public static $css = '';
    public static $alt = '';
    public static $source;

    public static function css($value)
    {
        self::$css = $value;

        return new static();
    }

    public static function alt($value)
    {
        self::$alt = $value;

        return new static();
    }

    public static function source($value)
    {
        self::$source = $value;

        return new static();
    }

    public static function thumbnail()
    {
        self::$thumbnail = true;

        return new static();
    }

    public static function placeholder()
    {
        self::$placeholder = true;

        return new static();
    }

    public static function fluid()
    {
        self::$fluid = true;

        return new static();
    }

    public static function process()
    {
        $html = '';
        $alt = self::$alt;
        $source = self::$source;
        $class = self::$css;

        if (self::$thumbnail) {
            $class .= " img-thumbnail";
        }

        if (self::$fluid) {
            $class .= " img-fluid";
        }

        if (self::$placeholder) {
            $html .= '<div class="html-placeholder">';
        }

        $class = trim($class);
        $html .= "<img class=\"{$class}\" src=\"{$source}\" alt=\"{$alt}\" />";

        if (self::$placeholder) {
            $html .= '</div>';
        }

         self::$html = $html;
    }

    public static function styles()
    {
        return <<<CSS
            .html-placeholder {
                background: #555;
                border-radius: 8px;
            }
CSS;
    }
}
