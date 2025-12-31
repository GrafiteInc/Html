<?php

namespace Grafite\Html\Tags;

use Grafite\Html\Tags\HtmlComponent;

class Announcement extends HtmlComponent
{
    public static $background = 'info';
    public static $heading;
    public static $dismiss;
    public static $timeout;
    public static $position;

    public static function background($value)
    {
        self::$background = $value;

        return new static();
    }

    public static function timeout($value)
    {
        self::$timeout = $value;

        return new static();
    }

    public static function position($value)
    {
        self::$position = $value;

        return new static();
    }

    public static function heading($value)
    {
        self::$heading = $value;

        return new static();
    }

    public static function dismiss($state = true)
    {
        self::$dismiss = $state;

        return new static();
    }

    public static function js()
    {
        $timeout = self::$timeout;

        return <<<JS
            document.addEventListener('DOMContentLoaded', function () {
                setTimeout(function () {
                    let announcement = bootstrap.Alert.getOrCreateInstance('.html-announcement')
                    announcement.close();
                }, {$timeout});
            });
        JS;
    }

    public static function styles()
    {
        $position = self::$position ?? 'top';

        return <<<CSS
            .html-announcement {
                width: calc(100% - 30px);
                left: 15px;
                $position: 15px;
                position: fixed;
                max-width: 100%;
                z-index: 30000;
            }
        CSS;
    }

    public static function process()
    {
        $bg = self::$background ?? 'info';
        $message = self::$text;
        $heading = self::$heading;

        $class = "alert-{$bg}";
        $header = '';
        $close = '';

        if (self::usingBootstrap5()) {
            $class = "bg-{$bg}";
        }

        if ($heading) {
            $header = "<h4 class=\"alert-heading\">{$heading}</h4>";
        }

        if (self::$dismiss) {
            $close = '<button type="button" class="close float-right" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>';

            if (self::usingBootstrap5()) {
                $close = '<button type="button" class="btn-close float-end" data-bs-dismiss="alert" aria-label="Close"></button>';
            }
        }

        self::$html = <<<html
        <div class="alert {$class} html-announcement fade show" role="alert">
            {$header}
            {$message}
            {$close}
        </div>
html;
    }
}
