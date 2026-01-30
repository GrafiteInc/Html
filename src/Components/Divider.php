<?php

namespace Grafite\Html\Components;

use Grafite\Html\Tags\Divider as DividerTag;

class Divider extends HtmlComponent
{
    public $text = '';

    public function __construct(
        $text,
    ) {
        $this->text = $text;
    }

    public function render()
    {
        return DividerTag::make()
            ->text($this->text)
            ->render();
    }
}
