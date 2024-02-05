<?php

namespace Grafite\Html\Tags;

use Exception;
use Illuminate\Support\Str;
use Grafite\Html\Tags\HtmlComponent;

class Carousel extends HtmlComponent
{
    public static function process()
    {
        $id = self::$id ?? 'html_carousel_' . Str::uuid() . '_';

        if (! Str::of(get_class(self::$items))->contains('Collection')) {
            throw new Exception("Items must be a collection.", 1);
        }

        $indicators = self::$items->map(function ($item, $key) use ($id) {
            $active = ($key === 1) ? 'active' : '';
            return "<button data-target=\"#${id}Indicators\" data-bs-target=\"#${id}Indicators\" data-slide-to=\"${key}\" data-bs-slide-to=\"${key}\" class=\"{$active}\"></button>";
        })->implode("\n");

        $items = self::$items->map(function ($item, $key) {
            $active = ($key === 1) ? ' active' : '';
            return "<div class=\"carousel-item{$active}\"><img src=\"{$item}\" class=\"d-block w-100\"></div>";
        })->implode("\n");

        self::$html = <<<html
<div id="{$id}Indicators" class="carousel slide" data-ride="carousel" data-bs-ride="carousel">
  <div class="carousel-indicators">
    {$indicators}
  </div>
  <div class="carousel-inner">
    {$items}
  </div>
  <button class="carousel-control-prev" type="button" data-target="#{$id}Indicators" data-slide="prev" data-bs-target="#{$id}Indicators" data-bs-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </button>
  <button class="carousel-control-next" type="button" data-target="#{$id}Indicators" data-slide="next" data-bs-target="#{$id}Indicators" data-bs-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </button>
</div>
html;
    }
}
