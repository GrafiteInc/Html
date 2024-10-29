<?php

namespace Grafite\Html\Components;

use Grafite\Html\Components\HtmlComponent;
use Grafite\Html\Tags\WordSwitcher as WordSwitcherTag;

class WordSwitcher extends HtmlComponent
{
    public $items;
    public $css;
    public $duration;
    public $delay;
    public $random;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(
        $items = [],
        $css = '',
        $duration = null,
        $delay = null,
        $random = null
    ) {
        $this->items = $items;
        $this->css = $css;
        $this->duration = $duration;
        $this->delay = $delay;
        $this->random = $random;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return function (array $data) {
            if (empty($this->items)) {
                $this->items = (string) $data['slot'];
            }

            return WordSwitcherTag::make()
                ->items($this->items)
                ->css($this->css)
                ->duration($this->duration)
                ->delay($this->delay)
                ->random($this->random)
                ->render();
        };
    }
}
