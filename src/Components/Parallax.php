<?php

namespace Grafite\Html\Components;

use Grafite\Html\Components\HtmlComponent;
use Grafite\Html\Tags\Parallax as ParallaxTag;

class Parallax extends HtmlComponent
{
    public $image;
    public $css;
    public $scale;
    public $delay;
    public $orientation;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(
        $image = null,
        $css = null,
        $scale = null,
        $delay = null,
        $orientation = null,
    ) {
        $this->image = $image;
        $this->css = $css;
        $this->scale = $scale;
        $this->delay = $delay;
        $this->orientation = $orientation;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return function (array $data) {
            return ParallaxTag::make()
                ->image($this->image)
                ->css($this->css)
                ->scale($this->scale)
                ->delay($this->delay)
                ->orientation($this->orientation)
                ->render();
        };
    }
}
