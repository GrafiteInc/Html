<?php

namespace Grafite\Html\Components;

use Illuminate\View\Component;
use Grafite\Html\Tags\NavButton as NavButtonTag;

class NavButton extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(
        public $onClick = '',
        public $css = '',
        public $content = null
    ) {
    }

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

            return NavButtonTag::make()
                ->onClick($this->onClick)
                ->css($this->css)
                ->text($this->content)
                ->render();
        };
    }
}
