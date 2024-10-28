<?php

namespace Grafite\Html\Components;

use Grafite\Html\Components\HtmlComponent;
use Grafite\Html\Tags\WordSwitcher as WordSwitcherTag;

class WordSwitcher extends HtmlComponent
{
    public $items;
    public $css;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(
        $items = [],
        $css = ''
    ) {
        $this->items = $items;
        $this->css = $css;
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
                ->render();
        };
    }
}
