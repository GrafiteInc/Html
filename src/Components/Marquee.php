<?php

namespace Grafite\Html\Components;

use Grafite\Html\Tags\Marquee as MarqueeTag;

class Marquee extends HtmlComponent
{
    public $content;

    public $css;

    public $reverse;

    public $pauseOnHover;

    public $vertical;

    public $repeat;

    public $duration;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(
        $content = null,
        $css = null,
        $reverse = null,
        $pauseOnHover = null,
        $vertical = null,
        $repeat = null,
        $duration = null,
    ) {
        $this->content = $content;
        $this->css = $css;
        $this->reverse = $reverse;
        $this->pauseOnHover = $pauseOnHover;
        $this->vertical = $vertical;
        $this->repeat = $repeat;
        $this->duration = $duration;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return function (array $data) {
            $content = $this->content ?? $data['slot'] ?? '';

            return MarqueeTag::make()
                ->content($content)
                ->css($this->css)
                ->reverse($this->reverse)
                ->pauseOnHover($this->pauseOnHover)
                ->vertical($this->vertical)
                ->repeat($this->repeat)
                ->duration($this->duration)
                ->render();
        };
    }
}
