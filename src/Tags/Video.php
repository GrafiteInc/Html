<?php

namespace Grafite\Html\Tags;

use Illuminate\Support\Str;
use Grafite\Html\Tags\HtmlComponent;

class Video extends HtmlComponent
{
    public static $type;
    public static $source;
    public static $poster;

    public static function type($value)
    {
        self::$type = $value;

        return new static();
    }


    public static function source($value)
    {
        self::$source = $value;

        return new static();
    }

    public static function poster($value)
    {
        self::$poster = $value;

        return new static();
    }

    public static function stylesheets()
    {
        return [
            '//cdn.plyr.io/3.7.8/plyr.css',
        ];
    }

    public static function scripts()
    {
        return [
            '//cdn.plyr.io/3.7.8/plyr.js',
        ];
    }

    public static function js()
    {
        $id = self::$id;

        return <<<JS
           document.addEventListener('DOMContentLoaded', (event) => {
                const player = new Plyr('#{$id}');
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
        $type = self::$type;
        $source = self::$source;
        $poster = self::$poster ?? '';

        if ($type === 'video') {
            self::$html = <<<HTML
                <video id="{$id}" playsinline controls data-poster="{$poster}">
                    <source src="{$source}" type="video/mp4" />
                </video>
            HTML;
        }

        if ($type === 'audio') {
            self::$html = <<<HTML
                <audio id="{$id}" controls>
                    <source src="{$source}" type="audio/mp3" />
                </audio>
            HTML;
        }

        if (in_array($type, ['youtube', 'vimeo'])) {
            self::$html = <<<HTML
                <div class="plyr__video-embed" id="{$id}">
                    <iframe
                        src="{$source}"
                        allowfullscreen
                        allowtransparency
                        allow="autoplay"
                    ></iframe>
                </div>
            HTML;
        }
    }
}
