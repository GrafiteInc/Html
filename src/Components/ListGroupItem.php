<?php

namespace Grafite\Html\Components;

use Illuminate\View\Component;

class ListGroupItem extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(public $href, public $content = null)
    {
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return function (array $data) {
            $active = '';

            if (empty($this->content)) {
                $this->content = (string) $data['slot'];
            }

            if (request()->url() === $this->href) {
                $active = 'active';
            }

            return "<a href=\"{$this->href}\" class=\"list-group-item list-group-item-action{$active}\">{$this->content}</a>\n";
            ;
        };
    }
}
