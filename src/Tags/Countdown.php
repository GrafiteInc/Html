<?php

namespace Grafite\Html\Tags;

use Exception;
use Illuminate\Support\Str;
use Grafite\Html\Tags\HtmlComponent;

class Countdown extends HtmlComponent
{
    public static $time;

    public static function time($value)
    {
        self::$time = $value;

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
        $time = self::$time->toJson();

        return <<<JS
            document.addEventListener('DOMContentLoaded', (event) => {
                var textWrapper = document.querySelector('#{$id}');
                // Set the date we're counting down to
                var countDownDate = new Date("{$time}").getTime();

                // Update the count down every 1 second
                var x = setInterval(function() {

                // Get today's date and time
                var now = new Date().getTime();

                // Find the distance between now and the count down date
                var distance = countDownDate - now;

                // Time calculations for days, hours, minutes and seconds
                var days = Math.floor(distance / (1000 * 60 * 60 * 24));
                var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
                var seconds = Math.floor((distance % (1000 * 60)) / 1000);

                // Output the result in an element with id="demo"
                document.getElementById("{$id}").innerHTML = days + "d " + hours + "h "
                + minutes + "m " + seconds + "s ";

                // If the count down is over, write some text
                if (distance < 0) {
                    clearInterval(x);
                    document.getElementById("demo").innerHTML = "EXPIRED";
                }
                }, 1000);
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

        self::$html = <<<HTML
            <span id="{$id}">
            </span>
        HTML;
    }
}
