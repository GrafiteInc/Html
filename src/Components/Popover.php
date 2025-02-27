<?php

namespace Grafite\Html\Components;

use Grafite\Html\Components\HtmlComponent;
use Grafite\Html\Tags\Popover as PopoverTag;

class Popover extends HtmlComponent
{
    public $title;
    public $css;
    public $trigger;
    public $content;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(
        $title = '',
        $css = '',
        $trigger = '',
        $content = ''
    ) {
        $this->title = $title;
        $this->css = $css;
        $this->trigger = $trigger;
        $this->content = $content;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illucontentate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return function (array $data) {
            if (empty($this->content)) {
                $this->content = (string) $data['slot'];
            }

            return PopoverTag::make()
                ->title($this->title)
                ->css($this->css)
                ->trigger($this->trigger)
                ->content($this->content)
                ->render();
        };
    }
}
