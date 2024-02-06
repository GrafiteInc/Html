<?php

namespace Grafite\Html\Tags;

use Illuminate\Support\Str;
use Grafite\Html\Tags\HtmlComponent;

class ImageCompare extends HtmlComponent
{
    public static $imageA;
    public static $imageB;
    public static $width;
    public static $height;
    public static $color = 'var(--bs-primary)';

    public static function imageA($value)
    {
        self::$imageA = $value;

        return new static();
    }

    public static function imageB($value)
    {
        self::$imageB = $value;

        return new static();
    }

    public static function width($value)
    {
        self::$width = $value;

        return new static();
    }

    public static function height($value)
    {
        self::$height = $value;

        return new static();
    }

    public static function color($value)
    {
        self::$color = $value;

        return new static();
    }

    public static function stylesheets()
    {
        return [];
    }

    public static function scripts()
    {
        return [];
    }

    public static function js()
    {
        $id = self::$id;

        return <<<JS
            document.addEventListener('DOMContentLoaded', (event) => {
                function initComparisons() {
                    var x, i;
                    /* Find all elements with an "overlay" class: */
                    x = document.getElementsByClassName("img-comp-overlay");
                    for (i = 0; i < x.length; i++) {
                        /* Once for each "overlay" element:
                        pass the "overlay" element as a parameter when executing the compareImages function: */
                        compareImages(x[i]);
                    }
                    function compareImages(img) {
                        var slider, img, clicked = 0, w, h;
                        /* Get the width and height of the img element */
                        w = img.offsetWidth;
                        h = img.offsetHeight;
                        /* Set the width of the img element to 50%: */
                        img.style.width = (w / 2) + "px";
                        /* Create slider: */
                        slider = document.createElement("DIV");
                        slider.setAttribute("class", "img-comp-slider");
                        /* Insert slider */
                        img.parentElement.insertBefore(slider, img);
                        /* Position the slider in the middle: */
                        slider.style.top = (h / 2) - (slider.offsetHeight / 2) + "px";
                        slider.style.left = (w / 2) - (slider.offsetWidth / 2) + "px";
                        /* Execute a function when the mouse button is pressed: */
                        slider.addEventListener("mousedown", slideReady);
                        /* And another function when the mouse button is released: */
                        window.addEventListener("mouseup", slideFinish);
                        /* Or touched (for touch screens: */
                        slider.addEventListener("touchstart", slideReady);
                        /* And released (for touch screens: */
                        window.addEventListener("touchend", slideFinish);

                        function slideReady(e) {
                            /* Prevent any other actions that may occur when moving over the image: */
                            e.preventDefault();
                            /* The slider is now clicked and ready to move: */
                            clicked = 1;
                            /* Execute a function when the slider is moved: */
                            window.addEventListener("mousemove", slideMove);
                            window.addEventListener("touchmove", slideMove);
                        }

                        function slideFinish() {
                            /* The slider is no longer clicked: */
                            clicked = 0;
                        }

                        function slideMove(e) {
                            var pos;
                            /* If the slider is no longer clicked, exit this function: */
                            if (clicked == 0) return false;
                            /* Get the cursor's x position: */
                            pos = getCursorPos(e)
                            /* Prevent the slider from being positioned outside the image: */
                            if (pos < 0) pos = 0;
                            if (pos > w) pos = w;
                            /* Execute a function that will resize the overlay image according to the cursor: */
                            slide(pos);
                        }

                        function getCursorPos(e) {
                            var a, x = 0;
                            e = (e.changedTouches) ? e.changedTouches[0] : e;
                            /* Get the x positions of the image: */
                            a = img.getBoundingClientRect();
                            /* Calculate the cursor's x coordinate, relative to the image: */
                            x = e.pageX - a.left;
                            /* Consider any page scrolling: */
                            x = x - window.pageXOffset;
                            return x;
                        }

                        function slide(x) {
                            /* Resize the image: */
                            img.style.width = x + "px";
                            /* Position the slider: */
                            slider.style.left = img.offsetWidth - (slider.offsetWidth / 2) + "px";
                        }
                    }
                }

                initComparisons();
            });
        JS;
    }

    public static function styles()
    {
        $width = self::$width;
        $height = self::$height;
        $color = self::$color;

        return <<<CSS
            .img-comp-container {
                position: relative;
                height: {$height}px;
            }

            .img-comp-img {
                position: absolute;
                width: auto;
                height: auto;
                overflow: hidden;
            }

            .img-comp-img img {
                display: block;
                vertical-align: middle;
            }

            .img-comp-slider {
                position: absolute;
                z-index: 9;
                cursor: ew-resize;
                /*set the appearance of the slider:*/
                width: 40px;
                height: 40px;
                background-color: $color;
                opacity: 0.7;
                border-radius: 50%;
            }
        CSS;
    }

    public static function process()
    {
        self::$id = static::$attributes['id'] ?? 'html_' . Str::uuid();

        $id = self::$id;
        $imageA = self::$imageA;
        $imageB = self::$imageB;
        $width = self::$width;
        $height = self::$height;

        self::$html = <<<HTML
            <div id="{$id}" class="img-comp-container">
                <div class="img-comp-img">
                    <img src="{$imageA}" width="{$width}" height="{$height}">
                </div>
                <div class="img-comp-img img-comp-overlay">
                    <img src="{$imageB}" width="{$width}" height="{$height}">
                </div>
            </div>
        HTML;
    }
}
