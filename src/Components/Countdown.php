<?php

namespace Grafite\Html\Components;

use Grafite\Html\Components\HtmlComponent;
use Grafite\Html\Tags\Countdown as CountdownTag;

class Countdown extends HtmlComponent
{
    public $time;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(
        $time = null,
    ) {
        $this->time = $time;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return function (array $data) {
            return CountdownTag::make()
                ->time($this->time)
                ->render();
        };
    }
}
