<?php

namespace Grafite\Html\Tags;

use Illuminate\Support\Str;
use Grafite\Html\Tags\HtmlComponent;

class Lightbox extends HtmlComponent
{
    public static $gallery;
    public static $thumbnailCss;

    public static function gallery($value)
    {
        self::$gallery = $value;

        return new static();
    }

    public static function thumbnailCss($value)
    {
        self::$thumbnailCss = $value;

        return new static();
    }

    public static function stylesheets()
    {
        return [];
    }

    public static function scripts()
    {
        return [
            '//cdn.jsdelivr.net/npm/fslightbox@3.4.1/index.min.js',
        ];
    }

    public static function js()
    {
        $id = self::$id;
        $gallery = self::$gallery;

        return <<<JS
           document.addEventListener('DOMContentLoaded', (event) => {
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
        self::$gallery = self::$gallery ?? 'lightbox_' . Str::uuid();

        $id = self::$id;
        $html = '<div id="'.$id.'" class="lightbox-gallery">';
        $gallery = self::$gallery;
        $items = self::$items;
        $thumbnailCss = self::$thumbnailCss;

        foreach ($items as $key => $item) {
            $html .= "<a class='lightbox-image-container' href='{$item}' data-fslightbox='{$gallery}'>
                <img class='{$thumbnailCss}' src='{$item}'>
            </a>";
        }

        $html .= '</div>';

        self::$html = $html;
    }
}
