<?php

namespace Grafite\Html\Components;

use Grafite\Html\Tags\Card as CardTag;
use Grafite\Html\Components\HtmlComponent;

class Card extends HtmlComponent
{
    public $body;
    public $title;
    public $header;
    public $footer;
    public $imageSrc;
    public $imageAlt;
    public $shadow;

    public function __construct(
        $body = null,
        $title = null,
        $header = null,
        $footer = null,
        $imageSrc = null,
        $imageAlt = null,
        $shadow = 'shadow-sm'
    ) {
        $this->body = $body;
        $this->title = $title;
        $this->header = $header;
        $this->footer = $footer;
        $this->imageSrc = $imageSrc;
        $this->imageAlt = $imageAlt;
        $this->shadow = $shadow;
    }

    public function render()
    {
        return function (array $data) {
            if (empty($this->body)) {
                $this->body = (string) $data['slot'];
            }

            return CardTag::make()
                ->body($this->body)
                ->title($this->title)
                ->header($this->header)
                ->footer($this->footer)
                ->image($this->imageSrc, $this->imageAlt)
                ->shadow($this->shadow)
                ->render();
        };
    }
}
