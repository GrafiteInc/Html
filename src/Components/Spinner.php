<?php

namespace Grafite\Html\Components;

use Grafite\Html\Components\HtmlComponent;
use Grafite\Html\Tags\Spinner as SpinnerTag;

class Spinner extends HtmlComponent
{
    public $css;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(
        $css = null
    ) {
        $this->css = $css;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return SpinnerTag::make()->css($this->css)->render();
    }
}
