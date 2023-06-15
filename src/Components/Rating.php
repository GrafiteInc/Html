<?php

namespace Grafite\Html\Components;

use Grafite\Html\Components\HtmlComponent;
use Grafite\Html\Tags\Rating as RatingTag;

class Rating extends HtmlComponent
{
    public $value;
    public $max;

    public function __construct($value = 0, $max = 5)
    {
        $this->value = $value;
        $this->max = $max;
    }

    public function render()
    {
        return RatingTag::make()
            ->max($this->max)
            ->value($this->value)
            ->render();
    }
}
