<?php

namespace Grafite\Html\Components;

use Grafite\Html\Tags\ListGroup as ListGroupTag;
use Illuminate\View\Component;

class ListGroup extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(
        public $items = [],
    ) {}

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return function (array $data) {
            if (empty($this->items)) {
                $this->items = [(string) $data['slot']];
            }

            return ListGroupTag::make()->items($this->items)->render();
        };
    }
}
