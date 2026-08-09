<?php

namespace Grafite\Html\Components;

use Grafite\Html\Tags\Swap as SwapTag;

class Swap extends HtmlComponent
{
    public $on;

    public $off;

    public $active;

    public $rotate;

    public $flip;

    public function __construct(
        $on = null,
        $off = null,
        $active = false,
        $rotate = false,
        $flip = false,
        $css = null,
    ) {
        $this->on = $on;
        $this->off = $off;
        $this->active = $active;
        $this->rotate = $rotate;
        $this->flip = $flip;
        $this->css = $css;
    }

    public function render()
    {
        return SwapTag::make()
            ->on($this->on)
            ->off($this->off)
            ->active($this->active)
            ->rotate($this->rotate)
            ->flip($this->flip)
            ->css($this->css)
            ->render();
    }
}
