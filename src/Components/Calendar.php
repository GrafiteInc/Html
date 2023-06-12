<?php

namespace Grafite\Html\Components;

use Grafite\Html\Tags\Calendar as CalendarTag;
use Grafite\Html\Components\HtmlComponent;

class Calendar extends HtmlComponent
{
    public function __construct(
        $items = [],
    ) {
        $this->items = $items;
    }

    public function render()
    {
        return CalendarTag::make()
            ->items($this->items)
            ->render();
    }
}
