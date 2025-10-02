<?php

namespace Grafite\Html\Components;

use Grafite\Html\Tags\Admonition as AdmonitionTag;
use Grafite\Html\Components\HtmlComponent;

class Admonition extends HtmlComponent
{
    public $body;
    public $title;
    public $icon;
    public $color;

    public function __construct(
        $body = null,
        $title = null,
        $color = null,
        $icon = null,
    ) {
        $this->body = $body;
        $this->title = $title;
        $this->color = $color;
        $this->icon = $icon;
    }

    public function render()
    {
        return function (array $data) {
            if (empty($this->body)) {
                $this->body = (string) $data['slot'];
            }

            return AdmonitionTag::make()
                ->body($this->body)
                ->title($this->title)
                ->icon($this->icon)
                ->color($this->color)
                ->render();
        };
    }
}
