<?php

namespace Grafite\Html\Components;

use Grafite\Html\Tags\Carousel as CarouselTag;
use Illuminate\View\Component;

class Carousel extends Component
{
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
        return CarouselTag::make()->items($this->items)->render();
    }
}
