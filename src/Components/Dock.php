<?php

namespace Grafite\Html\Components;

use Grafite\Html\Tags\Dock as DockTag;

class Dock extends HtmlComponent
{
    public $position;

    public $size;

    public $magnify;

    public $fixed;

    public function __construct(
        $items = [],
        $position = 'bottom',
        $size = 'md',
        $magnify = true,
        $fixed = false,
        $css = null,
    ) {
        $this->items = $items;
        $this->position = $position;
        $this->size = $size;
        $this->magnify = $magnify;
        $this->fixed = $fixed;
        $this->css = $css;
    }

    public function render()
    {
        return DockTag::make()
            ->items($this->items)
            ->position($this->position)
            ->size($this->size)
            ->magnify($this->magnify)
            ->fixed($this->fixed)
            ->css($this->css)
            ->render();
    }
}
