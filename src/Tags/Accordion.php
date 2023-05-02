<?php

namespace Grafite\Html\Tags;

use Illuminate\Support\Str;
use Grafite\Html\Tags\HtmlComponent;

class Accordion extends HtmlComponent
{
    public static function process()
    {
        $id = self::$id ?? Str::random(16);
        $items = self::processLinks(self::$items, $id);

        self::$html = <<<HTML
            <div class="accordion" id="{$id}_Accordion">
                {$items}
            </div>
HTML;
    }

    public static function processLinks($items, $id)
    {
        $index = 1;
        $steps = '';

        foreach ($items as $key => $value) {
            $steps .= <<<HTML
                <div class="accordion-item">
                    <h2 class="accordion-header" id="{$id}_{$index}">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#{$id}_Collapse_{$index}" aria-expanded="true" aria-controls="{$id}_Collapse_{$index}">
                            {$key}
                        </button>
                    </h2>
                    <div id="{$id}_Collapse_{$index}" class="accordion-collapse collapse" aria-labelledby="{$id}_{$index}" data-bs-parent="#{$id}_Accordion">
                        <div class="accordion-body">
                            {$key}
                        </div>
                    </div>
                </div>
HTML;
            $index++;
        }

        return $steps;
    }
}
