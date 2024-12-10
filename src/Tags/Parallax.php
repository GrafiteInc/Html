<?php

namespace Grafite\Html\Tags;

use Illuminate\Support\Str;
use Grafite\Html\Tags\HtmlComponent;

class Parallax extends HtmlComponent
{
    public static $image;
    public static $scale;
    public static $delay;
    public static $orientation;

    public static function image($value)
    {
        self::$image = $value;

        return new static();
    }

    public static function scale($value)
    {
        self::$scale = $value;

        return new static();
    }

    public static function delay($value)
    {
        self::$delay = $value;

        return new static();
    }

    public static function orientation($value)
    {
        self::$orientation = $value;

        return new static();
    }

    public static function stylesheets()
    {
        return [];
    }

    public static function scripts()
    {
        return [
            '//cdn.jsdelivr.net/npm/simple-parallax-js@6.0.1/dist/vanilla/simpleParallaxVanilla.umd.min.js',
        ];
    }

    public static function js()
    {
        $id = self::$id;
        $config = json_encode([
            'scale' => self::$scale ?? '1.2',
            'delay' => self::$delay ?? '0.4',
            'orientation' => self::$orientation ?? 'up',
        ]);

        return <<<JS
           document.addEventListener('DOMContentLoaded', (event) => {
                var image = document.getElementById('{$id}');
                new SimpleParallax(image, {$config});
            });
        JS;
    }

    public static function styles()
    {
        return <<<CSS

        CSS;
    }

    public static function process()
    {
        self::$id = static::$attributes['id'] ?? 'html_' . Str::uuid();

        $id = self::$id;
        $image = self::$image;
        $css = self::$css;

        self::$html = <<<HTML
             <img id="{$id}" class="{$css}" src="{$image}">
        HTML;
    }
}
