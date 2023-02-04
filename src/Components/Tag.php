<?php

namespace Grafite\Html\Components;

use Grafite\Html\Components\HtmlComponent;

class Tag extends HtmlComponent
{
    public $component;

    public $data;

    public function __construct($component = null, $data = [])
    {
        $this->component = $component;
        $this->data = $data;
    }

    public function render()
    {
        return $this->component::make()->data($this->data)->render();
    }
}
