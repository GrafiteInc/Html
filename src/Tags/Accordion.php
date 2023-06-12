<?php

namespace Grafite\Html\Tags;

use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Grafite\Html\Tags\HtmlComponent;

class Accordion extends HtmlComponent
{
    public static $show = false;

    public static function show($value)
    {
        self::$show = $value;

        return new static();
    }

    public static function process()
    {
        $show = self::$show;
        $id = self::$id ?? Str::random(16);
        $items = self::processLinks(self::$items, $id, $show);

        self::$html = <<<HTML
            <div class="accordion" id="{$id}_Accordion">
                {$items}
            </div>
HTML;
    }

    public static function processLinks($items, $id, $show)
    {
        $index = 1;
        $steps = '';

        foreach ($items as $key => $originalValue) {
            $key = Str::of($key)->title();
            $value = $originalValue;

            if (is_array($originalValue)) {
                $value = '<ul>';
                $value .= collect($originalValue)->map(function ($string) {
                    return '<li>' . Str::of($string)->title() . '</li>';
                })->implode(' ');
                $value .= '</ul>';
            }

            $steps .= <<<HTML
                <div class="accordion-item">
                    <h2 class="accordion-header" id="{$id}_{$index}">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#{$id}_Collapse_{$index}" aria-expanded="true" aria-controls="{$id}_Collapse_{$index}">
                            {$key}
                        </button>
                    </h2>
                    <div id="{$id}_Collapse_{$index}" class="accordion-collapse collapse show" aria-labelledby="{$id}_{$index}" data-bs-parent="#{$id}_Accordion">
                        <div class="accordion-body">
                            {$value}
                        </div>
                    </div>
                </div>
HTML;
            $index++;
        }

        return $steps;
    }
}
