<?php

namespace Grafite\Html\Components;

use Grafite\Html\Components\HtmlComponent;
use Grafite\Html\Tags\NavDropdown as NavDropdownTag;

class NavDropdown extends HtmlComponent
{
    public $items;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(
        $items = [],
        $text = null,
        $cssClass = null,
    ) {
        $this->items = $items;
        $this->text = $text;
        $this->css = $cssClass;
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
                $this->items = [(string) $data['slot']];
            }

            return NavDropdownTag::make()
                ->text($this->text)
                ->css($this->css)
                ->items($this->items)
                ->render();
        };
    }
}
