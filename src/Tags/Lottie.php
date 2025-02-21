<?php

namespace Grafite\Html\Tags;

use Illuminate\Support\Str;
use Grafite\Html\Tags\HtmlComponent;

class Lottie extends HtmlComponent
{
    public static $image;
    public static $icon;
    public static $speed;
    public static $trigger;
    public static $color;
    public static $stroke;

    public static function image($value)
    {
        self::$image = $value;

        return new static();
    }

    public static function trigger($value)
    {
        self::$trigger = $value;

        return new static();
    }

    public static function color($value)
    {
        self::$color = $value;

        return new static();
    }

    public static function stroke($value)
    {
        self::$stroke = $value;

        return new static();
    }

    public static function speed($value)
    {
        self::$speed = $value;

        return new static();
    }

    public static function icon($value)
    {
        self::$icon = $value;

        return new static();
    }

    public static function stylesheets()
    {
        return [];
    }

    public static function scripts()
    {
        return [
            '//cdn.jsdelivr.net/npm/lottie-web@5.12.2/build/player/lottie.min.js',
        ];
    }

    public static function js()
    {
        $id = self::$id;
        $trigger = self::$trigger;
        $icon = self::$icon;

        try {
            $img = file_get_contents('../vendor/grafite/html/images/'.$icon.'.json');
        } catch (\Throwable $th) {
            throw new \Exception('Icon not found');
        }

        return <<<JS
            document.addEventListener('DOMContentLoaded', function () {
                var _loop = false;
                var _autoplay = false;

                if ('{$trigger}' === 'loop') {
                    _loop = true;
                    _autoplay = true;
                }


                var svgContainer = document.getElementById('{$id}');
                var _speed = parseFloat(svgContainer.getAttribute('data-speed'));

                if (isNaN(_speed)) {
                    _speed = 1;
                }

                var animItem = bodymovin.loadAnimation({
                    wrapper: svgContainer,
                    animType: 'svg',
                    loop: _loop,
                    autoplay: _autoplay,
                    animationData: {$img}
                });

                animItem.setSpeed(_speed);

                if ('{$trigger}' === 'click') {
                    svgContainer.addEventListener('click', (e) => {
                        animItem.play();
                    });
                }

                if ('{$trigger}' === 'hover') {
                    svgContainer.addEventListener('mouseenter', (e) => {
                        animItem.setDirection(1);
                        animItem.play();
                    });

                    svgContainer.addEventListener('mouseleave', (e) => {
                        animItem.setDirection(-1);
                        animItem.play();
                    });
                }
            });
        JS;
    }

    public static function styles()
    {
        $id = self::$id;
        $color = self::$color ?? 'var(--bs-primary)';
        $stroke = self::$stroke ?? 3;

        return <<<CSS
            #{$id} svg g path {
                stroke: {$color};
                fill: {$color};
                stroke-width: {$stroke}px;
            }
        CSS;
    }

    public static function process()
    {
        self::$id = static::$attributes['id'] ?? 'html_' . Str::uuid();

        $id = self::$id;
        $speed = self::$speed;

        self::$html = <<<HTML
            <div
                id="{$id}"
                data-speed="{$speed}"
            ></div>
        HTML;
    }
}
