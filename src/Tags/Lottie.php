<?php

namespace Grafite\Html\Tags;

use Illuminate\Support\Str;

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

        return new static;
    }

    public static function trigger($value)
    {
        self::$trigger = $value;

        return new static;
    }

    public static function color($value)
    {
        self::$color = $value;

        return new static;
    }

    public static function stroke($value)
    {
        self::$stroke = $value;

        return new static;
    }

    public static function speed($value)
    {
        self::$speed = $value;

        return new static;
    }

    public static function icon($value)
    {
        self::$icon = $value;

        return new static;
    }

    public static function stylesheets()
    {
        return [];
    }

    public static function scripts()
    {
        return [
            '//cdn.jsdelivr.net/npm/lottie-web@5.13.0/build/player/lottie.min.js',
        ];
    }

    public static function js()
    {
        $id = self::$id;
        $trigger = self::$trigger;
        $icon = self::$icon;
        $stroke = (float) (self::$stroke ?? 3);

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

                var animationData = {$img};

                /*
                 * Scale stroke widths so every icon's main lines render at the same
                 * on-screen thickness (the stroke value, in px). The icons are drawn
                 * with a main line weight of 18 units on a 500 unit canvas, and the
                 * exported widths already account for each layer's own transforms, so
                 * one factor per icon keeps the design's proportions (thin details,
                 * thick accents) intact. Applying a fixed CSS stroke-width instead gets
                 * multiplied by those transforms and varies from icon to icon.
                 */
                (function (data, strokePx, container) {
                    var width = container.clientWidth;
                    var height = container.clientHeight;
                    var ratio = width > 0 ? width / data.w : 100 / data.w;

                    if (width > 0 && height > 0) {
                        ratio = Math.min(width / data.w, height / data.h);
                    }

                    var factor = strokePx / (ratio * data.w * 0.036);

                    var scaleValue = function (prop) {
                        if (prop.a === 1) {
                            prop.k.forEach(function (frame) {
                                ['s', 'e'].forEach(function (key) {
                                    if (frame[key]) {
                                        frame[key] = [frame[key][0] * factor];
                                    }
                                });
                            });

                            return;
                        }

                        var current = Array.isArray(prop.k) ? prop.k[0] : prop.k;

                        // Strokes authored with no width are intentionally hidden.
                        if (current) {
                            prop.k = current * factor;
                        }
                    };

                    var visit = function (node) {
                        if (! node || typeof node !== 'object') {
                            return;
                        }

                        if (Array.isArray(node)) {
                            node.forEach(visit);

                            return;
                        }

                        // Most widths are expressions driven by the icon's own "Stroke
                        // Change" slider (or linked to a sibling stroke), so scale the
                        // slider and only touch widths that aren't expressions.
                        if (node.ty === 'st' && node.w && node.w.k !== undefined && ! node.w.x) {
                            scaleValue(node.w);
                        }

                        if (/Stroke Change/.test(node.nm || '')) {
                            (node.ef || []).forEach(function (effect) {
                                (effect.ef || []).forEach(function (param) {
                                    if (param.nm === 'Slider' && param.v && param.v.k !== undefined) {
                                        scaleValue(param.v);
                                    }
                                });
                            });
                        }

                        visit(node.layers);
                        visit(node.shapes);
                        visit(node.it);
                        visit(node.assets);
                    };

                    visit(data);
                })(animationData, {$stroke}, svgContainer);

                var animItem = bodymovin.loadAnimation({
                    wrapper: svgContainer,
                    animType: 'svg',
                    loop: _loop,
                    autoplay: _autoplay,
                    animationData: animationData
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

        // Stroke widths are normalized in the animation data (see js()), so only
        // the colors are set here. Lottie gives stroke paths a stroke-linecap and
        // fill paths none, which keeps fills from picking up an outline.
        return <<<CSS
            #{$id} svg g path[stroke-linecap] {
                stroke: {$color};
            }

            #{$id} svg g path:not([stroke-linecap]) {
                fill: {$color};
            }
        CSS;
    }

    public static function process()
    {
        self::$id = static::$attributes['id'] ?? 'html_'.Str::uuid();

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
