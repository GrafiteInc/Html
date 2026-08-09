<?php

namespace Grafite\Html\Components;

use Grafite\Html\Tags\Kbd as KbdTag;

class Kbd extends HtmlComponent
{
    public $size;

    public function __construct(
        $text = null,
        $size = null,
        $css = null,
    ) {
        $this->text = $text;
        $this->size = $size;
        $this->css = $css;
    }

    public function render()
    {
        return KbdTag::make()
            ->text($this->text)
            ->size($this->size)
            ->css($this->css)
            ->render();
    }
}
