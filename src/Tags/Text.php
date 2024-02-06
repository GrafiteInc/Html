<?php

namespace Grafite\Html\Tags;

use Exception;
use Illuminate\Support\Str;
use Grafite\Html\Tags\HtmlComponent;

class Text extends HtmlComponent
{
    public static $effect;

    public static function effect($value)
    {
        self::$effect = $value;

        return new static();
    }

    public static function stylesheets()
    {
        return [
            // '//cdn.plyr.io/3.7.8/plyr.css',
        ];
    }

    public static function scripts()
    {
        return [
            '//cdnjs.cloudflare.com/ajax/libs/animejs/2.0.2/anime.min.js',
        ];
    }

    public static function js()
    {
        $id = self::$id;
        $effect = self::$effect;

        if (! in_array($effect, ['fade', 'drop-in', 'roll-in', 'fall-in'])) {
            throw new Exception("Invalid Effect.", 1);
        }

        if ($effect === 'fade') {
            return <<<JS
                document.addEventListener('DOMContentLoaded', (event) => {
                    var textWrapper = document.querySelector('#{$id}');
                        textWrapper.innerHTML = textWrapper.textContent.replace(/\S/g, "<span class='letter'>$&</span>");

                    anime.timeline({
                        loop: false
                    }).add({
                        targets: '#{$id} .letter',
                        opacity: [0,1],
                        easing: "easeInOutQuad",
                        duration: 2250,
                        delay: (el, i) => 150 * (i+1)
                    }).add({
                        targets: '#{$id}',
                        opacity: 100,
                        duration: 1000,
                        easing: "easeOutExpo",
                        delay: 1000
                    });
                });
            JS;
        }

        if ($effect === 'drop-in') {
            return <<<JS
            document.addEventListener('DOMContentLoaded', (event) => {
                var textWrapper = document.querySelector('#{$id}');
                    textWrapper.innerHTML = textWrapper.textContent.replace(/\S/g, "<span class='letter d-inline-block'>$&</span>");

                    anime.timeline({
                        loop: false
                    }).add({
                        targets: '#{$id} .letter',
                        scale: [4,1],
                        opacity: [0,1],
                        translateZ: 0,
                        easing: "easeOutExpo",
                        duration: 950,
                        delay: (el, i) => 70*i
                    }).add({
                        targets: '#{$id}',
                        opacity: 100,
                        duration: 1000,
                        easing: "easeOutExpo",
                        delay: 1000
                    });
                });
            JS;
        }

        if ($effect === 'roll-in') {
            return <<<JS
            document.addEventListener('DOMContentLoaded', (event) => {
                var textWrapper = document.querySelector('#{$id}');
                    textWrapper.innerHTML = textWrapper.textContent.replace(/\S/g, "<span class='letter d-inline-block'>$&</span>");

                    anime.timeline({
                        loop: false
                    }).add({
                        targets: '#{$id} .letter',
                        translateY: ["1.1em", 0],
                        translateZ: 0,
                        duration: 750,
                        delay: (el, i) => 50 * i
                    }).add({
                        targets: '#{$id}',
                        opacity: 0,
                        duration: 1000,
                        easing: "easeOutExpo",
                        delay: 1000
                    });
                });
            JS;
        }

        if ($effect === 'fall-in') {
            return <<<JS
            document.addEventListener('DOMContentLoaded', (event) => {
                var textWrapper = document.querySelector('#{$id}');
                    textWrapper.parentNode.classList.add('overflow-y-hidden');
                    textWrapper.innerHTML = textWrapper.textContent.replace(/\S/g, "<span class='letter d-inline-block'>$&</span>");

                    anime.timeline({
                        loop: false
                    }).add({
                        targets: '#{$id} .letter',
                        translateY: [-100,0],
                        easing: "easeOutExpo",
                        duration: 1400,
                        delay: (el, i) => 60 * i
                    }).add({
                        targets: '#{$id}',
                        opacity: 100,
                        duration: 1000,
                        easing: "easeOutExpo",
                        delay: 1000
                    });
                });
            JS;
        }
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
        $text = self::$text;

        self::$html = <<<HTML
            <span id="{$id}">
                {$text}
            </span>
        HTML;
    }
}
