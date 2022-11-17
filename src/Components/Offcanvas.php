<?php

namespace Grafite\Html\Components;

use Grafite\Html\Components\HtmlComponent;
use Grafite\Html\Tags\OffCanvas as OffCanvasTag;

class Offcanvas extends HtmlComponent
{
    public $title;
    public $cssClass;
    public $id;
    public $position;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(
        $title = null,
        $cssClass = null,
        $id = null,
        $position = 'end'
    ) {
        $this->title = $title;
        $this->cssClass = $cssClass;
        $this->position = $position;
        $this->id = $id;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return OffCanvasTag::make()
            ->text($this->title)
            ->css($this->cssClass)
            ->id($this->id)
            ->position($this->position)
            ->render();
    }
}