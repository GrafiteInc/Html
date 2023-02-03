<?php

namespace Grafite\Html\Components;

use Grafite\Html\Components\HtmlComponent;

class Tag extends HtmlComponent
{
    public $component;

    public function __construct($component = null)
    {
        $this->component = $component;
    }

    public function render()
    {
        return $this->component::make()->render();
    }
}
