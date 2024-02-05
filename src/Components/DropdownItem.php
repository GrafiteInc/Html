<?php

namespace Grafite\Html\Components;

use Grafite\Html\Tags\DropdownItem as ItemTag;
use Grafite\Html\Components\HtmlComponent;

class DropdownItem extends HtmlComponent
{
    public $url;
    public $text;

    public function __construct($url = null, $text = null)
    {
        $this->text = $text;
        $this->url = $url;
    }

    public function render()
    {
        return function (array $data) {
            if (empty($this->text)) {
                $this->text = (string) $data['slot'];
            }

            return ItemTag::make()
                ->text($this->text)
                ->url($this->url)
                ->render();
        };
    }
}
