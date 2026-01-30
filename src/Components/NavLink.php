<?php

namespace Grafite\Html\Components;

use Grafite\Html\Tags\NavLink as NavLinkTag;
use Illuminate\View\Component;

class NavLink extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(
        public $href = '',
        public $content = null
    ) {}

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return function (array $data) {
            if (empty($this->content)) {
                $this->content = (string) $data['slot'];
            }

            return NavLinkTag::make()
                ->url($this->href)
                ->text($this->content)
                ->render();
        };
    }
}
