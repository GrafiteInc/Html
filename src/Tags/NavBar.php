<?php

namespace Grafite\Html\Tags;

use Illuminate\Support\Str;
use Grafite\Html\Tags\HtmlComponent;

class NavBar extends HtmlComponent
{
    public static $brand;

    public static function brand($value)
    {
        self::$brand = $value;

        return new static;
    }

    public static function process()
    {
        $class = '';

        if (self::$css) {
            $class = " $class ".self::$css;
        }

        $brand = self::$brand ?? '';

        if (! self::$id) {
            $id = 'html_'.Str::uuid();
        }

        $attributes = self::processAttributes([
            'class' => trim('navbar ' . $class),
        ]);

        $links = collect(self::$items)->implode("\n");

        self::$html = <<<html
<nav$attributes>
    <div class="container-fluid">
        <a class="navbar-brand" href="/">$brand</a>
        <button
            class="navbar-toggler"
            type="button"
            data-toggle="collapse"
            data-target="#$id"
            data-bs-toggle="collapse"
            data-bs-target="#$id"
            aria-controls="$id"
            aria-expanded="false"
            aria-label="Toggle navigation"
        >
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="$id">
            <ul class="navbar-nav mr-auto">
                $links
            </ul>
        </div>
    </div>
</nav>
html;
    }
}
