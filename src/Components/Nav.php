<?php

namespace Grafite\Html\Components;

use Grafite\Html\Tags\NavLink;
use Grafite\Html\Tags\Nav as NavTag;
use Grafite\Html\Components\HtmlComponent;

class Nav extends HtmlComponent
{
    public $items;
    public $type;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(
        $items = [],
        $type = 'tabs',
    ) {
        $this->items = $items;
        $this->type = $type;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return function (array $data) {
            $items = $this->processItems();

            if (empty($items)) {
                $items = [(string) $data['slot']];
            }

            $type = $this->type;

            return NavTag::make()
                ->items($items)
                ->$type()
                ->css($this->css)
                ->render();
        };
    }

    public function processItems()
    {
        $items = [];

        foreach (array_reverse($this->items) as $key => $value) {
            $items[] = NavLink::make()
                ->url("{$key}")
                ->text("{$value}")
                ->render();
        }

        return $items;
    }
}
