<?php

namespace Grafite\Html\Components;

use Grafite\Html\Tags\Avatar as AvatarTag;
use Grafite\Html\Components\HtmlComponent;

class Avatar extends HtmlComponent
{
    public $size;
    public $image;
    public $css;

    public function __construct(
        $image,
        $size = null,
        $css = null
    ) {
        $this->image = $image;
        $this->size = $size;
        $this->css = $css;
    }

    public function render()
    {
        return AvatarTag::make()
            ->image($this->image)
            ->size($this->size)
            ->css($this->css)
            ->render();
    }
}
