<?php

namespace Grafite\Html\Components;

use Grafite\Html\Tags\DropdownItem as ItemTag;
use Grafite\Html\Components\HtmlComponent;

class DropdownItem extends HtmlComponent
{
    public $url;

    public function __construct($url)
    {
        $this->url = $url;
    }

    public function render()
    {
        return function (array $data) {
            $this->text = $data['slot'];

            return ItemTag::make()
                ->text($this->text)
                ->url($this->url)
                ->render();
        };
    }
}
