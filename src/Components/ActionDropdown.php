<?php

namespace Grafite\Html\Components;

use Grafite\Html\Tags\DropdownButton;
use Grafite\Html\Components\HtmlComponent;

class ActionDropdown extends HtmlComponent
{
    public $actions;
    public $icon;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(
        $actions = [],
        $icon = '<span class="fa fa-ellipsis-vertical"></span>'
    ) {
        $this->actions = $actions;
        $this->icon = $icon;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return function (array $data) {
            if (empty($this->actions)) {
                $this->actions = [(string) $data['slot']];
            }

            return DropdownButton::make()
                ->items($this->actions)
                ->text($this->icon)
                ->css('btn-sm btn-outline-secondary without-arrow')
                ->menuCss('dropdown-menu-end')
                ->render();
        };
    }
}
