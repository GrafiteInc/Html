<?php

namespace Grafite\Html\Components;

use Grafite\Html\Tags\Accordion as AccordionTag;
use Illuminate\View\Component;

class Accordion extends Component
{
    public $show = false;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(public $items) {}

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return AccordionTag::make()->show($this->show)->items($this->items)->render();
    }
}
