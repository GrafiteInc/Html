<?php

namespace Grafite\Html\Tags;

use Grafite\Html\Tags\HtmlComponent;

class Alert extends HtmlComponent
{
    public static $background = 'info';
    public static $heading;
    public static $dismiss;

    public static function background($value)
    {
        self::$background = $value;

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
            $header = "<span class=\"alert-heading\">{$heading}</span>";
        }

        if (self::$dismiss) {
            $close = '<button type="button" class="close float-right" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>';

            if (self::usingBootstrap5()) {
                $close = '<button type="button" class="btn-close float-end" data-bs-dismiss="alert" aria-label="Close"></button>';
            }
        }

        self::$html = <<<html
        <div class="alert {$class} w-100 position-fixed" role="alert">
            {$header}
            {$message}
            {$close}
        </div>
html;
    }
}
