<?php

namespace Grafite\Html\Components;

use Grafite\Html\Components\HtmlComponent;
use Grafite\Html\Tags\Tilt as TiltTag;

class Tilt extends HtmlComponent
{
    public $content;
    public $startX;
    public $startY;
    public $glare;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(
        $content = null,
        $startX = 20,
        $startY = -20,
        $glare = 'false',
    ) {
        $this->content = $content;
        $this->startX = $startX;
        $this->startY = $startY;
        $this->glare = $glare;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return function (array $data) {
            $content = $this->content;

            if (! $content) {
                $content = (string) $data['slot'];
            }

            return TiltTag::make()
                ->content($content)
                ->startX($this->startX)
                ->startY($this->startY)
                ->glare($this->glare)
                ->render();
        };
    }
}
