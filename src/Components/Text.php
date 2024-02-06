<?php

namespace Grafite\Html\Components;

use Grafite\Html\Components\HtmlComponent;
use Grafite\Html\Tags\Text as TextTag;

class Text extends HtmlComponent
{
    public $text;
    public $effect;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(
        $text = null,
        $effect = 'fade-in'
    ) {
        $this->text = $text;
        $this->effect = $effect;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return function (array $data) {
            if (empty($this->text)) {
                $this->text = (string) $data['slot'];
            }

            return TextTag::make()
                ->text($this->text)
                ->effect($this->effect)
                ->render();
        };
    }
}
