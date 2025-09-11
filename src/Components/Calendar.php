<?php

namespace Grafite\Html\Components;

use Grafite\Html\Tags\Calendar as CalendarTag;
use Grafite\Html\Components\HtmlComponent;

class Calendar extends HtmlComponent
{
    public $initialView;
    public $dayOfWeekStart;

    public function __construct(
        $items = [],
        $initialView = 'dayGridMonth',
        $dayOfWeekStart = 0
    ) {
        $this->items = $items;
        $this->initialView = $initialView;
        $this->dayOfWeekStart = $dayOfWeekStart;
    }

    public function render()
    {
        return CalendarTag::make()
            ->initialView($this->initialView)
            ->dayOfWeekStart($this->dayOfWeekStart)
            ->items($this->items)
            ->render();
    }
}
