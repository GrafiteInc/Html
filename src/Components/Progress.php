<?php

namespace Grafite\Html\Components;

use Grafite\Html\Components\HtmlComponent;
use Grafite\Html\Tags\Progress as ProgressTag;

class Progress extends HtmlComponent
{
    public $now;
    public $min;
    public $max;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(
        $now = 0,
        $min = 0,
        $max = 100
    ) {
        $this->now = $now;
        $this->min = $min;
        $this->max = $max;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return ProgressTag::make()
            ->now($this->now)
            ->min($this->min)
            ->max($this->max)
            ->render();
    }
}
