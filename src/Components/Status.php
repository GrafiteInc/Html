<?php

namespace Grafite\Html\Components;

use Grafite\Html\Tags\Status as StatusTag;

class Status extends HtmlComponent
{
    public $color;

    public $thickness;

    public $style;

    public $offset;

    public $state;

    public function __construct(
        $color = null,
        $thickness = null,
        $style = null,
        $offset = null,
        $state = null,
    ) {
        $this->color = $color;
        $this->thickness = $thickness;
        $this->style = $style;
        $this->offset = $offset;
        $this->state = $state;
    }

    public function render()
    {
        return StatusTag::make()
            ->color($this->color)
            ->thickness($this->thickness)
            ->style($this->style)
            ->offset($this->offset)
            ->state($this->state)
            ->render();
    }
}
